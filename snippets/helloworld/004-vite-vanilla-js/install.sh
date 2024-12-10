docker pull node:23-alpine
docker run node:23-alpine node -v
docker run node:23-alpine npm -v 


docker run --rm -it -v $(pwd)/app:/app -p 5173:5173 -w /app node:23-alpine /bin/sh
docker run --rm -it -v "%cd%/app:/app" -p 5173:5173 -w /app node:23-alpine /bin/sh

docker run --rm -it -v "%cd%/app:/app" -p 5173:5173 -w /app node:23-alpine npm create vite@latest . 
docker run --rm -it -v "%cd%/app:/app" -p 5173:5173 -w /app node:23-alpine npm install

docker build -t hello-vanilla .
docker run -d --rm --name hello-vanilla -p 5173:5173 hello-vanilla
docker run --rm -it -v "%cd%/app:/app" -p 5173:5173 -w /app hello-vanilla /bin/sh

npm run dev -- --host 0.0.0.0
