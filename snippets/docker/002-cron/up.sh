#!/bin/bash
. clean.sh -s
docker-compose up -d
docker ps -a
read -p "done"
