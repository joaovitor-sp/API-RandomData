#!/bin/sh
# Espera o banco de dados estar pronto
./wait-for-it.sh db:5432 --timeout=30 --strict -- echo "DB up"

# Garante que dependências estão instaladas (opcional se já fez no build)
composer install --no-interaction --prefer-dist --optimize-autoloader

# concede permissão ao artisan
chmod +x artisan

# Roda migrations
php artisan migrate --force

# Inicia o servidor
php artisan serve --host=0.0.0.0 --port=8000
