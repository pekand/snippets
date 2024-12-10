docker pull node:23-alpine
docker run node:23-alpine node -v
docker run node:23-alpine npm -v 
docker run --rm -it -v $(pwd)/app:/app -w /app node:23-alpine npm init -y
docker run --rm -it -v $(pwd)/app:/app -w /app node:23-alpine npm install
docker run --rm -it -v $(pwd)/app:/app -w /app node:23-alpine /bin/sh
docker run --rm -it -v "%cd%/app:/app" -w /app node:23-alpine /bin/sh

docker build -t hello-node .
docker run -p 3000:3000 hello-node
