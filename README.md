# Laravel + Docker + Vite Setup

Este projeto é um **setup completo de Laravel 10** com **Docker**, **Supervisor** e **Vite** para gerenciar frontend (JS, SCSS/Bootstrap) e backend PHP, tudo automatizado para desenvolvimento e produção.

---

## 🏗 Estrutura do Projeto

- **Laravel**: Backend PHP
- **Vite**: Build de frontend (JS, SCSS, Bootstrap)
- **Docker**: Containerização
- **Supervisor**: Gerenciamento de processos PHP-FPM e Queue Worker
- **Composer**: Gerenciamento de dependências PHP
- **npm**: Gerenciamento de dependências frontend
- **storage/logs**: Logs do Laravel
- **bootstrap/cache**: Cache do Laravel

---

## 📦 Dockerfile

O `Dockerfile` faz o seguinte:

1. Base PHP 8.2 FPM
2. Instala dependências do sistema: `git`, `curl`, `zip`, `unzip`, `supervisor`, `nodejs`, `npm`
3. Instala extensões PHP obrigatórias para Laravel (`pdo`, `pdo_mysql`)
4. Copia a aplicação para `/var/www`
5. Instala dependências do Composer (`composer install`)
6. Ajusta permissões das pastas `storage` e `bootstrap/cache` (evita erros de log)
7. Copia e habilita o `entrypoint.sh`

---

## 🔧 entrypoint.sh

O `entrypoint.sh` é executado quando o container inicia. Ele faz:

1. Verifica se `.env` existe; caso contrário, copia `.env.example`
2. Gera a chave da aplicação Laravel (`php artisan key:generate --force`)
3. Em modo DEV, roda migrations e seeders:
   ```bash
   php artisan migrate --force
   php artisan db:seed --force
