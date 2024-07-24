FROM php:8.2-fpm

RUN apt-get update -y
RUN apt-get upgrade -y

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
WORKDIR /var/www/guest-service
COPY . .

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions @composer gd pdo_mysql

