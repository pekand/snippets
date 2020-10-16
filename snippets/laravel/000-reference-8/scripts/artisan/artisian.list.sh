cd $(dirname $0)/../../app

php artisan list

while :
do
    read -p "Help [command]: " name
    name=${name}
    php artisan help ${name}
    read -p "Press enter to continue"
done
