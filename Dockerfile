# Dockerfile for Laravel SaaS KlinikOS
FROM composer:2.9 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader --no-scripts

FROM node:20 AS frontend
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm install && npm run build || true

FROM php:8.4-fpm-alpine
WORKDIR /var/www
COPY --from=vendor /usr/bin/composer /usr/bin/composer
RUN apk add --no-cache bash icu-dev libzip-dev oniguruma-dev postgresql-dev
RUN docker-php-ext-install intl pdo pdo_pgsql zip opcache
RUN rm -rf /var/cache/apk/*

# Copy app source, excluding Mac ._ files and other dotfiles
COPY --from=vendor /app/vendor /var/www/vendor
COPY --from=frontend /app/node_modules /var/www/node_modules
COPY . /var/www
RUN find /var/www -name '._*' -delete

# Permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
