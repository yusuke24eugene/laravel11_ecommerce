#!/bin/bash

#!/bin/bash

# Wait for DB to be ready
echo "Waiting for database connection (timeout in 60s)..."
for i in {1..20}; do
  if php artisan migrate:status > /dev/null 2>&1; then
    break
  fi
  echo "Still waiting..."
  sleep 3
done

# Run Laravel setup commands
php artisan config:clear
php artisan route:clear
php artisan view:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache

php artisan migrate --force
php artisan storage:link

# Start Laravel
php artisan serve --host=0.0.0.0 --port=$PORT
