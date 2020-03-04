cd ../app
read -p "Update Model name [table]: " name
timestamp=$(date +%s)
php artisan make:migration update_${name}_table_${timestamp} --table=${name}
read -p "Press enter to continue"
