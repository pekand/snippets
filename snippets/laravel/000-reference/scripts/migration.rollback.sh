cd $(dirname $0)/../app
php artisan migrate:rollback --force
read -p "Press enter to continue"
