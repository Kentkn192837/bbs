FROM php:7.2-apache

ENV APACHE_DOCUMENT_ROOT /var/www/public

RUN apt-get update && \
    # PDO PostgreSQL 拡張
    apt-get install -y libpq-dev &&\
    docker-php-ext-install pdo_pgsql
