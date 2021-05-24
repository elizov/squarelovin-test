FROM php:7.4.2-fpm-alpine3.11

# User set up
ARG UID
ARG GID
ARG USER
RUN addgroup -g ${GID} -S ${USER} && adduser -u ${UID} -S ${USER} -G ${USER}

# Dependencies
RUN apk --no-cache add \
        curl \
        ffmpeg \
        libzip-dev \
        freetype \
        libpng \
        libjpeg-turbo \
        freetype-dev \
        libpng-dev \
        libjpeg-turbo-dev \
        exiftool \
        pcre-dev \
        ${PHPIZE_DEPS} \
    && pecl install \
        xdebug \
    && docker-php-ext-configure \
        gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        opcache \
        pdo \
        pdo_mysql \
        zip \
        gd \
        exif \
    && docker-php-ext-enable \
        xdebug \
    && apk del --no-cache \
        pcre-dev \
        freetype-dev \
        libpng-dev \
        libjpeg-turbo-dev \
        ${PHPIZE_DEPS}

# Testing
RUN apk --no-cache add \
    xvfb \
    chromium-chromedriver \
    chromium

# PHP configs
COPY php.ini /usr/local/etc/php/conf.d

# PHP-FPM
COPY www.conf /usr/local/etc/php-fpm.d
RUN rm /usr/local/etc/php-fpm.d/zz-docker.conf \
    && mkdir -p /var/run/php \
    && chown ${USER}:${USER} /var/run/php

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

USER ${USER}

# Install lint
RUN composer global require tightenco/tlint
