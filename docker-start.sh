#!/bin/bash
set -e

# Generate .env from environment variables if not exists
if [ ! -f /var/www/html/.env ]; then
    echo "APP_NAME=${APP_NAME:-Laravel}" > /var/www/html/.env
    echo "APP_ENV=${APP_ENV:-production}" >> /var/www/html/.env
    echo "APP_KEY=${APP_KEY}" >> /var/www/html/.env
    echo "APP_DEBUG=${APP_DEBUG:-false}" >> /var/www/html/.env
    echo "APP_URL=${APP_URL:-http://localhost}" >> /var/www/html/.env
    echo "APP_TIMEZONE=${APP_TIMEZONE:-UTC}" >> /var/www/html/.env
    echo "APP_LOCALE=${APP_LOCALE:-en}" >> /var/www/html/.env

    echo "DB_CONNECTION=${DB_CONNECTION:-mysql}" >> /var/www/html/.env
    echo "DB_HOST=${DB_HOST}" >> /var/www/html/.env
    echo "DB_PORT=${DB_PORT:-3306}" >> /var/www/html/.env
    echo "DB_DATABASE=${DB_DATABASE}" >> /var/www/html/.env
    echo "DB_USERNAME=${DB_USERNAME}" >> /var/www/html/.env
    echo "DB_PASSWORD=${DB_PASSWORD}" >> /var/www/html/.env

    echo "SESSION_DRIVER=${SESSION_DRIVER:-database}" >> /var/www/html/.env
    echo "SESSION_LIFETIME=${SESSION_LIFETIME:-120}" >> /var/www/html/.env
    echo "CACHE_STORE=${CACHE_STORE:-database}" >> /var/www/html/.env
    echo "QUEUE_CONNECTION=${QUEUE_CONNECTION:-database}" >> /var/www/html/.env

    echo "REDIS_CLIENT=${REDIS_CLIENT:-predis}" >> /var/www/html/.env
    echo "REDIS_HOST=${REDIS_HOST:-127.0.0.1}" >> /var/www/html/.env
    echo "REDIS_PORT=${REDIS_PORT:-6379}" >> /var/www/html/.env

    echo "MAIL_MAILER=${MAIL_MAILER:-log}" >> /var/www/html/.env
    echo "MAIL_HOST=${MAIL_HOST:-127.0.0.1}" >> /var/www/html/.env
    echo "MAIL_PORT=${MAIL_PORT:-2525}" >> /var/www/html/.env
    echo "MAIL_USERNAME=${MAIL_USERNAME}" >> /var/www/html/.env
    echo "MAIL_PASSWORD=${MAIL_PASSWORD}" >> /var/www/html/.env
    echo "MAIL_ENCRYPTION=${MAIL_ENCRYPTION}" >> /var/www/html/.env
    echo "MAIL_FROM_ADDRESS=${MAIL_FROM_ADDRESS:-hello@example.com}" >> /var/www/html/.env
    echo "MAIL_FROM_NAME=${MAIL_FROM_NAME:-Laravel}" >> /var/www/html/.env

    echo "LOG_CHANNEL=${LOG_CHANNEL:-stack}" >> /var/www/html/.env
    echo "LOG_LEVEL=${LOG_LEVEL:-error}" >> /var/www/html/.env

    echo "GOOGLE_CLIENT_ID=${GOOGLE_CLIENT_ID}" >> /var/www/html/.env
    echo "GOOGLE_CLIENT_SECRET=${GOOGLE_CLIENT_SECRET}" >> /var/www/html/.env
    echo "GOOGLE_REDIRECT_URL=${GOOGLE_REDIRECT_URL}" >> /var/www/html/.env
fi

cd /var/www/html

# Clear and cache config
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force

# Start Apache
exec apache2-foreground
