cd $(dirname $0)/../../app
chown -R www-data:www-data app
find ./app -type f -exec chmod 644 {} \;    
find ./app -type d -exec chmod 755 {} \;
cd $(dirname $0)/../app
chmod -R ug+rwx storage 
chmod -R ug+rwx bootstrap/cache
