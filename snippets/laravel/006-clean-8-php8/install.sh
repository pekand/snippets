php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && php composer-setup.php && php -r "unlink('composer-setup.php');"
php composer.phar create-project --prefer-dist "laravel/laravel:^8.0" app
cd app
composer require laravel/ui
php artisan ui bootstrap --auth
npm install
npm run dev
