FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN mkdir -p /run/php

WORKDIR /var/www/html/src

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

RUN composer global require laravel/installer

ENV PATH="/root/.composer/vendor/bin:${PATH}"

COPY ./docker/php8.3/www.conf /usr/local/etc/php-fpm.d/www.conf

COPY ./docker/php8.3/php.ini /usr/local/etc/php/php.ini

CMD ["php-fpm"]
