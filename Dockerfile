# Use an official PHP runtime as a parent image
FROM php:8.1-apache

# Install PostgreSQL extension for PHP
RUN docker-php-ext-install pgsql pdo_pgsql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set environment variables for PostgreSQL
ENV DB_HOST=your-postgresql-host
ENV DB_PORT=5432
ENV DB_NAME=your_database_name
ENV DB_USER=your_db_user
ENV DB_PASSWORD=your_db_password

# Copy the PHP application into the container
COPY src/ /var/www/html/

# Set file permissions
RUN chown -R www-data:www-data /var/www/html/

# Expose port 80 for the web server
EXPOSE 80

# Command to run the Apache server
CMD ["apache2-foreground"]
