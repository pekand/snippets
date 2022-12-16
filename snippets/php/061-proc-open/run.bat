@echo off
docker run --rm -v %cd%:"/script"  php:8.0.23-cli php /script/main.php
