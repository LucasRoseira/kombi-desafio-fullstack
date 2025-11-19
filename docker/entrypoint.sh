#!/bin/sh

set -e

echo "🚀 Entrypoint iniciado"

if [ ! -f /var/www/.env ]; then
    echo "📄 Criando .env"
    cp /var/www/.env.example /var/www/.env
fi

echo "🔑 Gerando APP_KEY"
php artisan key:generate --ansi


echo "📦 Instalando dependências PHP"
composer install --optimize-autoloader --no-interaction

echo "🔐 Ajustando permissões..."
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

echo "🔎 Esperando o MySQL..."
wait-for-mysql.sh

echo "📦 Executando migrations"
php artisan migrate --force

echo "🌱 Executando seed personalizado"
php artisan seed:clients

echo "🎉 Iniciando PHP-FPM"
exec php-fpm
