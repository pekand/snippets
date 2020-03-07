export SPECIAL_PATH="/foo/bin"
cd $(dirname $0)/../app
chrome http://127.0.0.1:8000
php artisan serve
