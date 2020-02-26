cd app
composer install --optimize-autoloader --no-dev
npm install
npm run dev

php artisan cache:clear
php artisan route:clear
php artisan route:cache
php artisan config:clear
php artisan config:cache
php artisan view:clear 

