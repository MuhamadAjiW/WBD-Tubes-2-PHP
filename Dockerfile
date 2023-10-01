FROM php:8.0-apache
WORKDIR /var/www/html
RUN a2enmod rewrite &&\
    docker-php-ext-install mysqli pdo pdo_mysql
COPY ./src .
EXPOSE 80