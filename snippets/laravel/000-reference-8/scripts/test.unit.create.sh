cd ../app
read -p "Unit name [User]: " name
php artisan make:test ${name}Test --unit
read -p "Press enter to continue"