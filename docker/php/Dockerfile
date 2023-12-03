ARG PHP_VERSION=8.1

FROM wordpress:php${PHP_VERSION:-8.1}-fpm-alpine
COPY php.ini /usr/local/etc/php/conf.d/gh-custom.ini
COPY ./docker-entrypoint.sh /docker-entrypoint.sh
RUN apk add --update --no-cache --virtual .build-deps linux-headers $PHPIZE_DEPS && \
    pecl install xdebug-3.2.0 redis && \
    docker-php-ext-enable xdebug redis && \
    apk del .build-deps && \
    chmod +x /docker-entrypoint.sh

ENTRYPOINT ["/docker-entrypoint.sh"]
CMD ["php-fpm"]
