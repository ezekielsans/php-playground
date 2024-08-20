# Use the official PHP image with Apache
FROM php:8.1-apache

# Install dependencies
RUN docker-php-ext-install pdo_mysql mysqli

# Set the working directory
WORKDIR /var/www/html

# Copy the application to the container
COPY /var/www/html/

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
