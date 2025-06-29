#!/bin/sh

echo "Starting Laravel Job Portal deployment..."

# Check if we're in Railway environment (has DATABASE_URL or MySQL variables)
if [ -n "$DATABASE_URL" ] || [ -n "$MYSQL_HOST" ]; then
    echo "Production environment detected, waiting for database..."
    
    # Wait for database to be ready
    until php artisan migrate:status > /dev/null 2>&1; do
        echo "Database not ready, waiting..."
        sleep 2
    done

    echo "Database is ready!"

    # Run migrations
    echo "Running migrations..."
    php artisan migrate --force

    # Seed database if empty
    echo "Checking if database needs seeding..."
    php artisan db:seed --force || echo "Seeding skipped (already seeded or failed)"
else
    echo "Local environment detected, skipping database operations..."
fi

# Cache configuration
echo "Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start the server
echo "Starting Laravel server on port ${PORT:-8080}..."
php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
