cd $(dirname $0)/../app
php composer.phar require laravel/ui
php composer.phar require doctrine/dbal
php artisan ui vue --auth
php artisan key:generate

npm install --global cross-env
npm install --no-bin-links
npm install 
npm run dev

read -p "Press enter to continue"
