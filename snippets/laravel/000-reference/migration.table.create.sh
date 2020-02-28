cd app
read -p "Model name [table]: " name
name=${name}
php artisan make:migration create_$name_table --create={$name}
read -p "Press enter to continue"