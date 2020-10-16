cd $(dirname $0)/../../app
read -p "Exception name [Custom]: " name
name=${name}
php artisan make:excetyion $nameExcepton
read -p "Press enter to continue"
