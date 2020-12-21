cd $(dirname $0)/../../app
#set header Retry-After
php artisan down --retry=60
