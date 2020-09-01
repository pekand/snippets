cd $(dirname $0)/../app
read -p "Command name [CommandName]: " name
php artisan make:command ${name}
read -p "Press enter to continue"
