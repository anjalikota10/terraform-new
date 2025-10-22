# Use official PHP image with Apache
FROM php:8.1-apache

# Set working directory inside the container
WORKDIR /var/www/html

# Copy application files to the Apache root directory
COPY . .

# Install required PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite (optional but useful for PHP apps)
RUN a2enmod rewrite

# Fix permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose Apache port
EXPOSE 80

# Start Apache in foreground
CMD ["apache2-foreground"]
