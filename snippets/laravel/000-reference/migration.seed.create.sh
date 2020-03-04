cd app
read -p "Create Table Seeder name [User]: " name
php artisan make:seeder ${name}Seeder
read -p "Press enter to continue"