FROM php:7.1-apache

RUN apt-get update && apt-get install -y git zlib1g-dev

# install ext php
RUN docker-php-ext-install zip

ADD ./localhost.conf /etc/apache2/sites-enabled/000-default.conf

EXPOSE 80

WORKDIR /var/www/html