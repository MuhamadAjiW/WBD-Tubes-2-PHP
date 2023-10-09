FROM php:8.2-apache
WORKDIR /var/www/html
RUN a2enmod rewrite &&\
    apt-get update &&\
    apt-get install -y libpq-dev &&\
    docker-php-ext-install pdo pdo_pgsql
EXPOSE 80