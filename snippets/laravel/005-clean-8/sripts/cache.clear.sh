cd $(dirname $0)/../app

DB_DATABASE=forge_clean
DB_USERNAME=dbadmin
DB_PASSWORD=dbadmin

php composer.phar dump-autoload
php artisan cache:clear
php artisan route:clear
php artisan config:clear
php artisan event:clear
php artisan view:clear  

