#!/bin/sh

set -e

echo "🚀 Entrypoint iniciado"

if [ ! -f /var/www/.env ]; then
    echo "📄 Criando .env"
    cp /var/www/.env.example /var/www/.env
fi

echo "🔎 Esperando o MySQL..."
wait-for-mysql.sh

echo "📦 Executando migrations"
php artisan migrate --force

echo "🌱 Executando seed personalizado"
php artisan seed:clients

echo "🎉 Iniciando PHP-FPM"
exec php-fpm
