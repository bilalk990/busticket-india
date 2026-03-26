#!/bin/bash

echo "🚀 Starting FastBuss Server..."

# Set proper permissions
echo "📁 Setting permissions..."
chmod -R 755 storage bootstrap/cache 2>/dev/null || true

# Clear old caches first
echo "🧹 Clearing old caches..."
php artisan config:clear 2>/dev/null || true
php artisan route:clear 2>/dev/null || true
php artisan view:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true

# Now optimize (this runs after clearing, so no conflicts)
echo "⚡ Optimizing application..."
php artisan config:cache 2>/dev/null || echo "⚠️  Config cache skipped"
php artisan route:cache 2>/dev/null || echo "⚠️  Route cache skipped"
php artisan view:cache 2>/dev/null || echo "⚠️  View cache skipped"

# Check database connection
echo "🔍 Checking database connection..."
php artisan migrate:status 2>/dev/null || echo "⚠️  Database connection issue detected"

# Start server
echo "✅ Starting PHP server on port ${PORT:-8080}..."
php -S 0.0.0.0:${PORT:-8080} -t public
