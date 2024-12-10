docker pull node:23-alpine
docker run node:23-alpine node -v
docker run node:23-alpine npm -v 
docker run --rm -it -v $(pwd)/app:/app -w /app node:23-alpine npm install
docker run --rm -it -v $(pwd)/app:/app -w /app node:23-alpine /bin/sh
docker run --rm -it -v "%cd%/app:/app" -w /app node:23-alpine /bin/sh
docker run --rm -it -v "%cd%/app:/app" -w /app node:23-alpine npx create-next-app@latest /app

docker build -t hello-react .
docker run -p 3000:3000 hello-react



