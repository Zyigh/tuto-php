FROM composer as deps
RUN mkdir -p /dependencies
WORKDIR /dependencies
COPY / .
RUN composer install --no-ansi --no-dev --no-interaction --no-progress --no-scripts --optimize-autoloader

FROM php:7.3-apache
WORKDIR /var/www
RUN a2enmod rewrite
COPY --from=deps /dependencies .
