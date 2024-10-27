FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    curl \
    git \
    zip \
    && docker-php-ext-install sockets \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/