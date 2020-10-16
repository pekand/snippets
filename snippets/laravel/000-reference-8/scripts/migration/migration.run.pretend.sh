cd $(dirname $0)/../../app
php artisan migrate --pretend --no-ansi > ../migration.run.pretend.sql

