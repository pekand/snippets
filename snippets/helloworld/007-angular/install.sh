#!/bin/bash
docker pull node:23-alpine
docker run node:23-alpine node -v
docker run node:23-alpine npm -v 


docker run --rm -it -v $(pwd)/app:/app -p 4200:4200 -w /app node:23-alpine /bin/sh
docker run --rm -it -v "%cd%/app:/app" -p 4200:4200 -w /app node:23-alpine /bin/sh

docker run --rm -it -v "%cd%/app:/app" -p 4200:4200 -w /app node:23-alpine npm install -g @angular/cli
docker run --rm -it -v "%cd%/app:/app" -p 4200:4200 -w /app node:23-alpine npm install

docker build -t hello-angular .
docker run -d --rm --name hello-angular -p 4200:4200 hello-angular
docker run --rm -it -v "%cd%/app:/app" -p 4200:4200 -w /app hello-angular /bin/sh

npm install -g @angular/cli
ng new .
ng version
ng serve --host 0.0.0.0