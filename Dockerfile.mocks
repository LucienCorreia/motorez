FROM php:8.3-fpm-alpine

RUN apk --no-cache add pcre-dev ${PHPIZE_DEPS} \
  && apk del pcre-dev ${PHPIZE_DEPS}

RUN apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    libxml2-dev \
    libzip-dev \
    icu-dev \
    zlib-dev \
    libpng \
    libjpeg-turbo \
    libxml2 \
    libzip \
    zlib \
    zip \
    unzip \
    postgresql-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure mysqli \
    && docker-php-ext-install -j$(nproc) pdo \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install zip \
    && docker-php-ext-install intl \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install xml

WORKDIR /app

USER root

COPY mocks /app

RUN chown -R www-data:www-data /app

EXPOSE 9000

CMD ["php-fpm"]
