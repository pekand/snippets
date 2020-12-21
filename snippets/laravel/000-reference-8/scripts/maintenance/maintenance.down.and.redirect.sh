cd $(dirname $0)/../../app
# prerender view
php artisan down --redirect="https://laravel.loc/maintanance.html"
read -p "done"
