cd $(dirname $0)/../../app
# prerender view
php artisan down --render="errors::maintenance"
read -p "done"
