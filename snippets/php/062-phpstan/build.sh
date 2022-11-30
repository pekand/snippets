#!/bin/bash

docker rmi php-test-docker:latest
docker build -t php-test-docker .
