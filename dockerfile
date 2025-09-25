FROM php:8.2-cli

# Instala extensões necessárias
RUN apt-get update && apt-get install -y \
    unzip git curl libzip-dev libpq-dev libonig-dev \
    && docker-php-ext-install zip pdo pdo_pgsql mbstring bcmath

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copia apenas composer.json e composer.lock para instalar dependências primeiro
COPY composer.json composer.lock ./
# RUN composer install --no-interaction --prefer-dist --optimize-autoloader
# Copia o restante do projeto (incluindo artisan)
COPY . .


# Copia scripts
COPY wait-for-it.sh /usr/local/bin/wait-for-it.sh
RUN chmod +x /usr/local/bin/wait-for-it.sh
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 8000

ENTRYPOINT ["/entrypoint.sh"]
