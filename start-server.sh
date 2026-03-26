#!/bin/bash

echo "🚀 Starting FastBuss Server..."

# Set proper permissions
echo "📁 Setting permissions..."
chmod -R 755 storage bootstrap/cache 2>/dev/null || true

# Clear and optimize
echo "🧹 Clearing caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

echo "⚡ Optimizing..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Check database connection
echo "🔍 Checking database connection..."
php artisan migrate:status || echo "⚠️  Database connection issue detected"

# Start server
echo "✅ Starting PHP server on port ${PORT:-8080}..."
php -S 0.0.0.0:${PORT:-8080} -t public
