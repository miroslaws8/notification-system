FROM php:8.2-fpm-alpine

RUN apk add --no-cache curl git build-base zlib-dev oniguruma-dev autoconf bash zip unzip npm yarn openssh-client postgresql-client

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod 777 /usr/local/bin/install-php-extensions
ARG PHP_EXTENSIONS="ldap intl xml bcmath mbstring zip sqlite3 apcu gd redis imagick exif pgsql pdo_pgsql pcntl"
RUN install-php-extensions ${PHP_EXTENSIONS}
RUN rm /usr/local/bin/install-php-extensions

WORKDIR /var/www/html

COPY ./../../ /var/www/html
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN php artisan queue:listen

CMD php-fpm

EXPOSE 9000
