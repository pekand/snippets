rm -rf app/node_modules
docker stop $(docker ps -q)
docker rmi hello-node