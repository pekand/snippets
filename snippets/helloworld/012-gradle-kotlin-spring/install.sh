docker run --rm -it --name spring-hello-world -v "%cd%/app:/app" -w /app -p 9000:8080  openjdk:21-jdk-slim /bin/bash

./gradlew build
docker build -t spring-hello-world .
docker run --rm -d  --name java-spring-app -p 9000:8080 spring-hello-world
docker run --rm -it --name java-spring-app -p 9000:8080 spring-hello-world

http://127.0.0.1:9000/
