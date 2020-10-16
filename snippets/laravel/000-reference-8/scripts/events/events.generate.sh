cd $(dirname $0)/../../app
# use configuration from EventServiceProvider
php artisan event:generate
read -p "Press enter to continue"
