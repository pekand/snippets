docker run --rm -it --name spring-hello-world -v "%cd%/app:/app" -w /app -p 9000:8080  openjdk:23-jdk-slim /bin/bash

./mvnw clean package
docker build -t spring-hello-world .
docker run -p 9000:8080 spring-hello-world
docker run --rm -it --name java-spring-app -p 9000:8080 spring-hello-world

http://127.0.0.1:9000/
