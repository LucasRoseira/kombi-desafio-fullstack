#!/bin/sh

set -e

echo "⏳ Aguardando MySQL ficar pronto..."

until php -r "new PDO('mysql:host=${DB_HOST};dbname=${DB_DATABASE}', '${DB_USERNAME}', '${DB_PASSWORD}');" 2>/dev/null; do
    sleep 1
done

echo "✅ MySQL está pronto!"
