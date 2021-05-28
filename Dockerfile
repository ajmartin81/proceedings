FROM php:7.3-fpm-stretch

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
    curl \
    libmemcached-dev \
    libz-dev \
    libpq-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libssl-dev \
    libxrender1 \
    # libxext6 \
    libmcrypt-dev

RUN docker-php-ext-install pdo_mysql

RUN apt-get install -y libicu-dev\
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl

RUN apt-get update \
    && apt-get install -y zlib1g-dev libzip-dev\
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install zip 

RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

RUN chown -R www-data:www-data /var/www
RUN mkdir /var/log/php
RUN touch /var/log/php/error.log
RUN chown -R www-data:www-data /var/log/php
RUN chown -R www-data:www-data /var/www
WORKDIR /var/www/html

USER www-data:www-data
