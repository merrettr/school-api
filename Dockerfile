FROM php:7.0-fpm

RUN apt-get update
RUN apt-get install git zip unzip -y

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"

RUN mv composer.phar /usr/local/bin/composer

RUN docker-php-ext-install pdo_mysql

WORKDIR /var/www/html
COPY . ./

RUN php /usr/local/bin/composer install
  && php artisan migrate:refresh --seed \
  && php artisan passport:install