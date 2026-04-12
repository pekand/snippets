#!/bin/bash

docker compose up -d --build
docker exec -it laravel_app /var/www/install.sh
