FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git curl zip unzip dos2unix \
    && apt-get clean

RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www

COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

COPY . .

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
COPY docker/wait-for-mysql.sh /usr/local/bin/wait-for-mysql.sh

RUN chmod +x /usr/local/bin/entrypoint.sh \
    && chmod +x /usr/local/bin/wait-for-mysql.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
