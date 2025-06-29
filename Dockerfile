FROM php:8.2-cli-alpine

# Install system dependencies
RUN apk add --no-cache \
    mysql-client \
    zip \
    unzip \
    git \
    curl \
    oniguruma-dev \
    libzip-dev \
    libpng-dev \
    jpeg-dev \
    freetype-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy composer files first for better caching
COPY composer.json composer.lock .env.example ./

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy application code
COPY . .

# Set permissions
RUN chmod -R 775 storage bootstrap/cache && \
    chown -R www-data:www-data storage bootstrap/cache

# Copy and make entrypoint executable
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Create .env file for build process using .env.example
RUN cp .env.example .env && \
    php artisan key:generate --force

# Expose port
EXPOSE 8080

# Use entrypoint script
CMD ["/entrypoint.sh"]
