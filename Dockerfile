# Use PHP 8.2 with Apache
FROM php:8.2-apache

# Install system dependencies + PHP extensions
RUN apt-get update && apt-get install -y \
    git curl zip unzip \
    libpng-dev libonig-dev libxml2-dev libzip-dev \
    nodejs npm \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite
RUN a2enmod rewrite headers

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy application files
COPY . /var/www/html

# Build-time .env (safe values, no real DB/Redis)
RUN echo "APP_KEY=base64:CQfOYvqg1MmuqDyaWm6coekjwC0WLRJ7KD134PQZrxo=" > .env \
    && echo "APP_ENV=production" >> .env \
    && echo "APP_DEBUG=false" >> .env \
    && echo "DB_CONNECTION=sqlite" >> .env \
    && echo "DB_DATABASE=/tmp/build.sqlite" >> .env \
    && echo "CACHE_STORE=array" >> .env \
    && echo "SESSION_DRIVER=array" >> .env \
    && echo "REDIS_CLIENT=predis" >> .env \
    && touch /tmp/build.sqlite

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts \
    && php artisan package:discover --ansi

# Install Node and build assets
RUN rm -f package-lock.json && npm install --include=dev && npm run build

# Permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Apache config - point to /public and handle PORT
RUN echo '<VirtualHost *:${PORT}>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
        Options -Indexes\n\
    </Directory>\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Startup script
COPY docker-start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

EXPOSE 80

CMD ["/usr/local/bin/start.sh"]
