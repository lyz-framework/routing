FROM php:8.2-apache

WORKDIR /var/www/html/

RUN apt-get update

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/bin/composer

RUN apt-get install -y libzip-dev && \
    docker-php-ext-install zip

COPY . .