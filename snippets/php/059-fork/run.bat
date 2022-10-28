@echo off
docker run --rm -v %cd%:"/script" php-custom php /script/fork.php
