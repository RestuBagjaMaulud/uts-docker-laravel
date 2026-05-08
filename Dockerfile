FROM php:8.2-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    zip unzip git curl libpng-dev libonig-dev libxml2-dev

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 👉 INI PENTING: masuk ke src
COPY src/ .

RUN composer install --no-interaction --prefer-dist

RUN chown -R www-data:www-data /var/www

EXPOSE 9000

CMD ["php-fpm"]