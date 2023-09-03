FROM php:8.2-fpm-alpine

# Atualiza o sistema
RUN apk update && apk upgrade

# Instala os pacotes de dependência das extensões do PHP
RUN apk add --no-cache \
    libzip-dev \
    icu-dev \
    g++

# Instala as extensões necessárias do PHP
RUN docker-php-ext-install pdo_mysql \
    && docker-php-ext-install intl \
    && docker-php-ext-install zip

# Instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install_dir=/usr/local/bin --filename=composer
RUN mv composer /usr/local/bin

# Ajusta a permissão para os arquivos do projeto
RUN chown -R www-data:www-data /var/www

# Inicia o PHP-FPM como entrada do contêiner
CMD ["php-fpm"]
