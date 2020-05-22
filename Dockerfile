FROM php:latest
RUN apt-get update && apt-get upgrade -y
RUN docker-php-ext-install mysqli
EXPOSe 80

