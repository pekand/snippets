cd $(dirname $0)/../app
php artisan migrate:rollback --step=1
read -p "Press enter to continue"
