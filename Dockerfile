FROM node:22-alpine AS vite-builder

WORKDIR /app

COPY package.json package-lock.json ./

RUN npm ci

COPY vite.config.js ./
COPY resources ./resources
COPY public ./public

RUN npm run build

FROM serversideup/php:8.3-fpm-nginx

USER root

RUN install-php-extensions pdo_pgsql

WORKDIR /var/www/html

COPY --chown=www-data:www-data . .

COPY --from=vite-builder --chown=www-data:www-data /app/public/build ./public/build

RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction

RUN mkdir -p storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

USER www-data

ENV PHP_OPCACHE_ENABLE=1
