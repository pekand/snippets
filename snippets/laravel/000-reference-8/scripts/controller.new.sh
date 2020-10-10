cd $(dirname $0)/../app
read -p "Model name [Controller]: " name
name=${name}
php artisan make:controller $name
read -p "Press enter to continue"
