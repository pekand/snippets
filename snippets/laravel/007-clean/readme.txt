

php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"

php composer.phar create-project laravel/laravel example-app

php artisan serve
http://127.0.0.1:8000
