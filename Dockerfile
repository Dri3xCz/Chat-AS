FROM php:7.4-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql sockets

RUN a2enmod rewrite proxy proxy_http proxy_wstunnel

WORKDIR /var/www/html

COPY ./app /var/www/html

RUN apt-get update && apt-get upgrade -y default-mysql-client

RUN docker-php-ext-install mysqli pdo pdo_mysql
