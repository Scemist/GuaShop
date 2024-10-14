FROM php:8.0-fpm-alpine

WORKDIR /srv

RUN apk add \
	composer \
	npm \
	libpq-dev

RUN apk add \
	php-tokenizer \
	php-xml \
	php-pdo \
	php-pdo_mysql \
	php-dom \
	php-xmlwriter \
	php-curl \
	php-openssl \
	php-mbstring \
	php-fileinfo

RUN docker-php-ext-install pdo_mysql