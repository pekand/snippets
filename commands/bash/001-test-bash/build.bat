docker pull oraclelinux:8.7
docker build --build-arg PROXY="http://proxy:8080" -t bash .