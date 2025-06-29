#!/bin/sh

echo "Starting Laravel Job Portal deployment..."

# Check if we're in Railway environment (check for Railway-specific variables)
if [ -n "$RAILWAY_ENVIRONMENT" ] || [ -n "$DATABASE_URL" ] || [ -n "$MYSQL_HOST" ] || [ -n "$PORT" ]; then
    echo "Production environment detected, setting up database..."
    
    # Give database a moment to start
    echo "Waiting 10 seconds for database to initialize..."
    sleep 10
    
    # Try to run migrations directly (will create migration table if needed)
    echo "Running migrations..."
    php artisan migrate --force || echo "Migration failed, continuing..."

    # Seed database if empty
    echo "Checking if database needs seeding..."
    php artisan db:seed --force || echo "Seeding skipped (already seeded or failed)"
else
    echo "Local environment detected, skipping database operations..."
fi

# Cache configuration (skip problematic caches)
echo "Caching configuration..."
php artisan config:cache || echo "Config cache skipped due to errors"

echo "Caching views..."
php artisan view:cache || echo "View cache skipped due to errors"

# Start the server
echo "Starting Laravel server on port ${PORT:-8080}..."
php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
