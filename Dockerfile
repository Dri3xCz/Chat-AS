FROM php:7.4-apache

WORKDIR /var/www/html

COPY ./app /var/www/html

RUN apt-get update && apt-get upgrade -y default-mysql-client

RUN docker-php-ext-install mysqli pdo pdo_mysql
