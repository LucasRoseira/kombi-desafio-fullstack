FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git curl zip unzip \
    && apt-get clean

RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www

COPY . .

COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage \
    && chmod -R 755 /var/www/bootstrap/cache
