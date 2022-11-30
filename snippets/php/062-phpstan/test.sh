#!/bin/bash

composer install --ignore-platform-reqs
php ./vendor/phpstan/phpstan/phpstan analyse --xdebug --memory-limit=-1 -c phpstan.neon
