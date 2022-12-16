#!/bin/bash

docker rmi php-custom
docker build -t php-custom .
