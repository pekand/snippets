cd $(dirname $0)/../app

DB_DATABASE=forge_clean
DB_USERNAME=dbadmin
DB_PASSWORD=dbadmin

php artisan migrate --force --seed

