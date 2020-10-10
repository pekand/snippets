./db.drop.sh
./db.create.sh
cd $(dirname $0)/../app
php artisan migrate:reset --force
php composer.phar dump-autoload
php artisan migrate --force --seed
read -p "Press enter to continue"
