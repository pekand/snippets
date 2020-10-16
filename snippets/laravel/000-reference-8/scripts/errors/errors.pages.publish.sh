cd $(dirname $0)/../../app
#create blade error page templates in resources
php artisan vendor:publish --tag=laravel-errors
read -p "Press enter to continue"
