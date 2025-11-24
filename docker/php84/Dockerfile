FROM php:8.4-fpm

ARG USER_ID=1000
ARG GROUP_ID=1000

RUN apt-get update && apt-get install -y \
    libicu-dev libpq-dev zip unzip git \
    && docker-php-ext-install intl pdo pdo_mysql \
    && docker-php-ext-enable intl

COPY ./php.ini /usr/local/etc/php/php.ini

RUN usermod -u ${USER_ID} www-data && groupmod -g ${GROUP_ID} www-data

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

USER www-data