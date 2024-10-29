FROM php:8.3-fpm

WORKDIR /src

RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .
RUN composer install --working-dir=/src

CMD ["php", "-a"]
