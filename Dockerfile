FROM php:8.1-apache

# Enable Apache rewrite
RUN a2enmod rewrite

# Install mysqli extension for CodeIgniter + MySQL
RUN docker-php-ext-install mysqli

# Increase upload limits
RUN echo "upload_max_filesize=20M" > /usr/local/etc/php/conf.d/uploads.ini \
 && echo "post_max_size=25M" >> /usr/local/etc/php/conf.d/uploads.ini \
 && echo "memory_limit=256M" >> /usr/local/etc/php/conf.d/uploads.ini \
 && echo "max_execution_time=300" >> /usr/local/etc/php/conf.d/uploads.ini \
 && echo "max_input_time=300" >> /usr/local/etc/php/conf.d/uploads.ini
