FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    zip unzip git curl libmcrypt-dev libonig-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring zip \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

COPY ./app .

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN php composer.phar install

EXPOSE 9000

CMD ["php-fpm"]