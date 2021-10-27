FROM php:8.0-fpm-alpine


RUN apk add icu-dev

RUN apk add --no-cache libzip-dev \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN docker-php-ext-configure intl && docker-php-ext-install intl

RUN apk add --no-cache libpng libpng-dev && docker-php-ext-install gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

