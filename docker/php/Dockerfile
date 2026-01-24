ARG PHP_VERSION=8.3
ARG NODE_VERSION=22

FROM php:${PHP_VERSION}-fpm-alpine AS base

RUN apk add --no-cache \
        bash \
        git \
        icu-dev \
        libjpeg-turbo-dev \
        libpng-dev \
        libzip-dev \
        oniguruma-dev \
        unzip \
        $PHPIZE_DEPS \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        gd \
        intl \
        mysqli \
        opcache \
        pdo_mysql \
        zip \
    && php -r "copy('https://getcomposer.org/installer','/tmp/composer-setup.php');" \
    && php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && rm /tmp/composer-setup.php

WORKDIR /var/www/html

FROM node:${NODE_VERSION}-slim AS theme-base

ARG FONTAWESOME_NPM_AUTH_TOKEN
ENV FONTAWESOME_NPM_AUTH_TOKEN=${FONTAWESOME_NPM_AUTH_TOKEN}

WORKDIR /theme

RUN apt-get update \
    && apt-get install -y git libnotify-bin \
    && npm config set '@fortawesome:registry' 'https://npm.fontawesome.com/' \
    && npm config set '//npm.fontawesome.com/:_authToken' "${FONTAWESOME_NPM_AUTH_TOKEN}" \
    && rm -rf /var/lib/apt/lists/*

CMD ["npm", "run", "watch"]
