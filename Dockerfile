FROM php:8.2-fpm

WORKDIR /var/www

# install dependencies
RUN apt-get update && apt-get install -y \
    zip unzip git curl libpng-dev libonig-dev libxml2-dev

# install php extensions
RUN docker-php-ext-install pdo pdo_mysql

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# copy project
COPY . .

# install dependencies
RUN composer install

# permission
RUN chown -R www-data:www-data /var/www

EXPOSE 9000

CMD ["php-fpm"]