chown -R www-data:www-data blog
find ./blog -type f -exec chmod 644 {} \;    
find ./blog -type d -exec chmod 755 {} \;
cd app 
chmod -R ug+rwx storage bootstrap/cache
