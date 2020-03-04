cd ../app
read -p "Model name [Controller]: " name
name=${name:-Controller}
echo $name
php artisan make:controller $name
read -p "Press enter to continue"
