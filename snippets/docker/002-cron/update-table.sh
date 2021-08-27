#!/bin/bash

docker exec -it cron crontab /etc/cron.d/cronjobs

read -p "done"
