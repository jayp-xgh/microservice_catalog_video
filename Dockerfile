FROM php:8.1.1-fpm

RUN apt-get update && apt-get install -y libzip-dev zip unzip git vim

RUN docker-php-ext-install zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/