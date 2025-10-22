# hello word elasticsearch
docker network create elastic-net
docker run -d --name elasticsearch --network elastic-net -p 9200:9200 -e "discovery.type=single-node" docker.elastic.co/elasticsearch/elasticsearch:8.11.0
#test server
curl http://localhost:9200
curl -u elastic:mysecretpassword http://localhost:9200
curl -u elastic:mysecretpassword http://elasticsearch:9200

docker run -it --rm --name php83 --network elastic-net -v "%cd%":/app -w /app php:8.3-cli bash

docker run -d --name elasticsearch --network elastic-net -p 9200:9200 -e ELASTIC_PASSWORD=mysecretpassword -e discovery.type=single-node -e xpack.security.enabled=true -e xpack.security.http.ssl.enabled=false docker.elastic.co/elasticsearch/elasticsearch:8.11.0
