#!/bin/bash

skip=0

while [[ "$#" -gt 0 ]]; do
    if [[ ( "$1" = "-s" ) || ( "$1" = "--skip" ) ]]; then
        skip=1
    fi

    shift
done

docker stop salt 
docker rm -v salt 
docker rmi salt 

docker stop minion 
docker rm -v minion 
docker rmi minion 

docker builder prune --all --force


if [[ !( "$skip" == 1 ) ]] ; then
    read -p "done"
fi
