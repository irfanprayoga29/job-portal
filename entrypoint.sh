#!/bin/sh

echo "Starting Laravel Job Portal deployment..."

# Check if we're in Railway environment (check for Railway-specific variables)
if [ -n "$RAILWAY_ENVIRONMENT" ] || [ -n "$DATABASE_URL" ] || [ -n "$MYSQL_HOST" ] || [ -n "$PORT" ]; then
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

# Cache configuration (skip route cache if there are errors)
echo "Caching configuration..."
php artisan config:cache

echo "Caching views..."
php artisan view:cache

echo "Attempting route cache (may skip if errors)..."
php artisan route:cache || echo "Route caching skipped due to errors"

# Start the server
echo "Starting Laravel server on port ${PORT:-8080}..."
php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
