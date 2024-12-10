#!/bin/bash

docker pull node:23-alpine


docker run --rm -it -v $(pwd)/app:/app -p 8080:80 -w /app php:8.4-fpm /bin/sh
docker run --rm -it -v "%cd%/app:/app" -p 8080:80 -w /app php:8.4-fpm /bin/sh

php composer.phar create-project --prefer-dist laravel/laravel laravel-hello-world

docker-compose down
docker-compose up -d --build

docker exec -it laravel_app php artisan migrate
docker exec -it laravel_app php composer install

