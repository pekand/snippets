cd $(dirname $0)/../../app

set XDEBUG_CONFIG=remote_enable=1 remote_mode=req remote_port=9000 remote_host=127.0.0.1 remote_connect_back=0

DB_DATABASE=forge_test
DB_USERNAME=forge_test
DB_PASSWORD=forge_test

php artisan cache:clear --env=testing
php artisan route:clear --env=testing
php artisan config:clear --env=testing
php artisan event:clear --env=testing
php artisan view:clear --env=testing
php artisan migrate:reset --force --env=testing
php artisan migrate --force --seed --env=testing

./vendor/bin/phpunit
read -p "Press enter to continue"
