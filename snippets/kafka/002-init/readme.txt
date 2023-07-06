RdKafka - php extension


https://www.baeldung.com/ops/kafka-docker-setup

docker-compose up -d
docker exec -it 001-init-kafka-1 /bin/bash
kafka-topics --create --topic test123 --partitions 1  --replication-factor 1 --bootstrap-server :9092
