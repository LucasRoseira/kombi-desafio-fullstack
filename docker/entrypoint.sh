#!/bin/bash
set -e

if [ ! -f /var/www/.env ]; then
    cp /var/www/.env.example /var/www/.env
fi

php artisan key:generate --force

exec "$@"
