
#get composer
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"

#create project
composer.phar create-project symfony/website-skeleton project

#run tests
php bin/phpunit
