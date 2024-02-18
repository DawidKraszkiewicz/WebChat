FROM php:8.2-fpm

RUN apt-get update -y && apt-get install -y git-core zip unzip libonig-dev libzip-dev libpq-dev nodejs npm
RUN docker-php-ext-install mbstring zip pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php; mv composer.phar /usr/local/bin/composer

USER www-data
