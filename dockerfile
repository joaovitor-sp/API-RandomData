FROM php:8.2-cli

# Instala extensões necessárias
RUN apt-get update && apt-get install -y \
    unzip git curl libzip-dev libpq-dev libonig-dev \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && docker-php-ext-install zip pdo pdo_pgsql mbstring bcmath

# Instala o Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Copia a configuração padrão do Xdebug
RUN echo "zend_extension=xdebug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.mode=debug,develop" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.idekey=VSCODE" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

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
