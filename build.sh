#!/bin/bash
set -e

echo "Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

echo "Installing NPM dependencies (including dev)..."
npm install --include=dev

echo "Building assets..."
NODE_ENV=development npm run build

echo "Build completed successfully!"
