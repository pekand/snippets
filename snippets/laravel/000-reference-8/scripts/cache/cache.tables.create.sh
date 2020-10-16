cd $(dirname $0)/../../app
# create tables for cache to database (default is to file)
php artisan cache:table
php artisan migrate
read -p "Press enter to continue"
