cd app

#update new seeds classies
php composer.phar dump-autoload

#insert seeds
php artisan db:seed --force
