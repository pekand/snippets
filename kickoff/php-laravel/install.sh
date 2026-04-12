#!/bin/bash

cd /var/www

cp .env.example .env
php artisan key:generate
composer install
php artisan migrate --seed
npm install
npm run build
