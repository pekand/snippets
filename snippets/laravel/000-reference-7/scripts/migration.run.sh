cd $(dirname $0)/../app
php artisan migrate --force
read -p "Press enter to continue"
