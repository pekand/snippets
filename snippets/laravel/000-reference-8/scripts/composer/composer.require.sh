cd $(dirname $0)/../../app
read -p "Package name name [custom/package]: " name
name=${name}
php composer.phar require $name
read -p "Press enter to continue"
