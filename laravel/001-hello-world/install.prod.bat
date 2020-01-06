cd blog
composer install --optimize-autoloader --no-dev
npm install
npm run dev
php artisan config:cache
php artisan route:cache
pause