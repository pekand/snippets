
./db.drop.sh
./db.create.sh
cd app
php artisan migrate:reset --force
php artisan migrate --force --seed
read -p "Press enter to continue"
