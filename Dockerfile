FROM php:7.4-apache

COPY . /app
WORKDIR /app

RUN php setup.php
CMD [ "php", "-S", "0.0.0.0:8000" ]
