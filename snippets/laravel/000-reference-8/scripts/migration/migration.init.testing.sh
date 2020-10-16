./db.drop.sh forge_test
./db.create.test.sh
cd $(dirname $0)/../../app
php artisan --env=testing migrate:reset --force
php composer.phar dump-autoload
php artisan --env=testing migrate --force --seed
