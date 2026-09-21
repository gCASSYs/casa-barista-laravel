FROM php:8.4-fpm

RUN apt-get update \
    && apt-get install -y libjpeg62-turbo-dev libpng-dev libwebp-dev libzip-dev unzip \
    && docker-php-ext-configure gd --with-jpeg --with-webp \
    && docker-php-ext-install gd pdo pdo_mysql zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY docker/php-entrypoint.sh /usr/local/bin/casa-barista-entrypoint
RUN chmod +x /usr/local/bin/casa-barista-entrypoint

ENTRYPOINT ["casa-barista-entrypoint"]
CMD ["php-fpm"]
