#!/bin/bash

docker run -it --rm -v "%cd%":/app -w /app php-test-docker bash test.sh


