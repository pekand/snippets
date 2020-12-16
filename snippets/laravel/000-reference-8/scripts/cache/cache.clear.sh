cd $(dirname $0)/../../app

php composer.phar dump-autoload
php artisan cache:clear
php artisan route:clear
php artisan config:clear
php artisan event:clear
php artisan view:clear  

read -p "done"
