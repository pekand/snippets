#!/bin/bash

skip=0

while [[ "$#" -gt 0 ]]; do
    if [[ ( "$1" = "-s" ) || ( "$1" = "--skip" ) ]]; then
        skip=1
    fi

    shift
done

docker stop cron 
docker rm -v cron 
docker rmi cron 

if [[ !( "$skip" == 1 ) ]] ; then
    read -p "done"
fi


