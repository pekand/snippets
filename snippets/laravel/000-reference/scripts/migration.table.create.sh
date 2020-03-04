cd ../app
read -p "Model name [table]: " name
php artisan make:migration create_${name}_table --create=${name}
read -p "Press enter to continue"
