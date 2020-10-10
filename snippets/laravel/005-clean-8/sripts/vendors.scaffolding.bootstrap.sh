cd $(dirname $0)/app
composer require laravel/ui
php artisan ui bootstrap
php artisan ui bootstrap --auth
npm install
npm run dev
