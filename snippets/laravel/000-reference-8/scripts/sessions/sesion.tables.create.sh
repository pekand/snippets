cd $(dirname $0)/../../app
php artisan session:table
php artisan migrate
read -p "Press enter to continue"
