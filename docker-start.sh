#!/bin/bash

APP_PORT="${PORT:-8000}"

echo "==> PORT is: $APP_PORT"

# Write .env
cat > /var/www/html/.env << ENVEOF
APP_NAME=${APP_NAME:-BusTicketIndia}
APP_ENV=${APP_ENV:-production}
APP_KEY=${APP_KEY}
APP_DEBUG=${APP_DEBUG:-false}
APP_URL=${APP_URL:-http://localhost}
APP_TIMEZONE=${APP_TIMEZONE:-UTC}
APP_LOCALE=${APP_LOCALE:-en}
APP_FALLBACK_LOCALE=${APP_FALLBACK_LOCALE:-en}

DB_CONNECTION=${DB_CONNECTION:-mysql}
DB_HOST=${DB_HOST}
DB_PORT=${DB_PORT:-3306}
DB_DATABASE=${DB_DATABASE}
DB_USERNAME=${DB_USERNAME}
DB_PASSWORD=${DB_PASSWORD}

SESSION_DRIVER=${SESSION_DRIVER:-database}
SESSION_LIFETIME=${SESSION_LIFETIME:-120}
CACHE_STORE=${CACHE_STORE:-database}
QUEUE_CONNECTION=${QUEUE_CONNECTION:-database}

REDIS_CLIENT=predis
REDIS_HOST=${REDIS_HOST:-127.0.0.1}
REDIS_PORT=${REDIS_PORT:-6379}

MAIL_MAILER=${MAIL_MAILER:-log}
MAIL_HOST=${MAIL_HOST}
MAIL_PORT=${MAIL_PORT:-587}
MAIL_USERNAME=${MAIL_USERNAME}
MAIL_PASSWORD=${MAIL_PASSWORD}
MAIL_ENCRYPTION=${MAIL_ENCRYPTION}
MAIL_FROM_ADDRESS=${MAIL_FROM_ADDRESS:-hello@example.com}
MAIL_FROM_NAME="${APP_NAME:-BusTicketIndia}"

LOG_CHANNEL=stack
LOG_LEVEL=${LOG_LEVEL:-error}

GOOGLE_CLIENT_ID=${GOOGLE_CLIENT_ID}
GOOGLE_CLIENT_SECRET=${GOOGLE_CLIENT_SECRET}
GOOGLE_REDIRECT_URL=${GOOGLE_REDIRECT_URL}
ENVEOF

echo "==> .env written"

cd /var/www/html

echo "==> Clearing config..."
php artisan config:clear || echo "config:clear failed, continuing..."

echo "==> Caching config..."
php artisan config:cache || echo "config:cache failed, continuing..."

echo "==> Running migrations..."
php artisan migrate --force --no-interaction || echo "migrate failed, continuing..."

echo "==> Starting server on 0.0.0.0:${APP_PORT}"
exec php artisan serve --host=0.0.0.0 --port=${APP_PORT}
