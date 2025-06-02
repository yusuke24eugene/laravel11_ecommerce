#!/bin/bash

# Wait for DB to be ready (optional but helpful in cloud)
echo "Waiting for database connection..."
until php artisan migrate:status > /dev/null 2>&1; do
  sleep 3
done

# Run Laravel commands
php artisan config:cache
php artisan route:cache
php artisan migrate --force

# Start the Laravel app
php artisan serve --host=0.0.0.0 --port=8000
