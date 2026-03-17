FROM php:8.2-cli

# Install system dependencies + PHP extensions
RUN apt-get update && apt-get install -y \
    git curl zip unzip \
    libpng-dev libonig-dev libxml2-dev libzip-dev \
    nodejs npm \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . /var/www/html

# Build-time .env
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
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

COPY docker-start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

EXPOSE 8000

# Direct command without script for testing
CMD ["sh", "-c", "echo 'DIRECT CMD STARTED' && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}"]
