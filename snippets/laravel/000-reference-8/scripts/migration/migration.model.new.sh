cd $(dirname $0)/../../app
read -p "Model name [Tickets]: " name
name=${name:-Tickets}
echo $name
php artisan make:model Models\\$name
read -p "Press enter to continue"
