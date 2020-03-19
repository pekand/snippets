cd $(dirname $0)/../app
composer install --optimize-autoloader --no-dev
npm install
npm run prod

php artisan cache:clear
php artisan route:clear
php artisan route:cache
php artisan config:clear
php artisan config:cache
php artisan event:clear
php artisan event:caches
php artisan view:clear 

