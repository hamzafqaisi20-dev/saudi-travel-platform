FROM php:8.2-fpm-alpine

RUN apk add --no-cache nginx nodejs npm git curl libpng-dev libxml2-dev zip unzip oniguruma-dev sqlite \
    && docker-php-ext-install pdo pdo_mysql bcmath mbstring gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

RUN mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache database \
    && touch database/database.sqlite \
    && chmod -R 777 storage bootstrap/cache database

EXPOSE 8080
CMD php artisan migrate --force; php artisan serve --host=0.0.0.0 --port=\
