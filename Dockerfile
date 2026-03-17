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
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy application files
COPY . /var/www/html

# Create a minimal .env for build time only
RUN echo "APP_KEY=base64:CQfOYvqg1MmuqDyaWm6coekjwC0WLRJ7KD134PQZrxo=" > .env && \
    echo "APP_ENV=production" >> .env && \
    echo "APP_DEBUG=false" >> .env && \
    echo "DB_CONNECTION=sqlite" >> .env && \
    echo "DB_DATABASE=/tmp/build.sqlite" >> .env && \
    echo "CACHE_STORE=array" >> .env && \
    echo "SESSION_DRIVER=array" >> .env && \
    echo "REDIS_CLIENT=predis" >> .env && \
    touch /tmp/build.sqlite

# Install PHP dependencies (no scripts to avoid artisan calls)
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Now run package:discover with safe env
RUN php artisan package:discover --ansi

# Install Node dependencies and build assets
# Remove package-lock.json to avoid platform-specific binary issues (Windows vs Linux)
RUN rm -f package-lock.json && npm install --include=dev && npm run build

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Configure Apache DocumentRoot to /public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

EXPOSE 80

CMD ["apache2-foreground"]
