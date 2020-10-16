cd $(dirname $0)/../../app
read -p "Feature name [User]: " name
php artisan make:test ${name}Test
read -p "Press enter to continue"

