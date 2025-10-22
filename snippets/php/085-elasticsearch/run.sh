#!/bin/bash
apt-get update && apt-get install -y curl unzip
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
composer require elasticsearch/elasticsearch
composer install
php test.php