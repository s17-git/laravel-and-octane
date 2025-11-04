# Stage 1: Build PHP with required extensions
FROM php:8.3-cli AS base

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip zip curl build-essential pkg-config \
    libpng-dev libonig-dev libxml2-dev libzip-dev libicu-dev \
    libssl-dev zlib1g-dev libcurl4-openssl-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer globally
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy composer files first for caching
COPY composer.json composer.lock ./

# Install PHP dependencies (without running artisan scripts)
RUN composer install --no-dev --no-scripts --optimize-autoloader --ignore-platform-reqs

# Now copy the rest of the project
COPY . .

# Install swoole via PECL (after adding build tools)
RUN pecl install swoole && docker-php-ext-enable swoole

# Set permissions for Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Discover Laravel packages (safe mode)
RUN php artisan package:discover --ansi || true

# Expose Octane port
EXPOSE 8000

# Start Octane using Swoole
CMD php artisan octane:start --server=swoole --host=0.0.0.0 --port=8000