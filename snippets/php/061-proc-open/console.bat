@echo off
docker run -it --rm -v %cd%:"/script" php-custom /bin/bash
