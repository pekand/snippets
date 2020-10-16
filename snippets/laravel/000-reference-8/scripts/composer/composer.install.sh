cd $(dirname $0)/../../app
php composer.phar clear-cache
php composer.phar install
read -p "Press enter to continue"
