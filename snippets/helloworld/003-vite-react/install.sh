docker pull node:23-alpine
docker run node:23-alpine node -v
docker run node:23-alpine npm -v 
docker run --rm -it -v $(pwd)/app:/app -w /app node:23-alpine npm install
docker run --rm -it -v $(pwd)/app:/app -w /app node:23-alpine /bin/sh
docker run --rm -it -v "%cd%/app:/app" -w /app node:23-alpine /bin/sh
docker run --rm -it -v "%cd%/app:/app" -w /app node:23-alpine npm create vite@latest /app --template react

docker build -t hello-vite .
docker run -d --name hello-vite -p 5173:5173 hello-vite
docker run --rm -it -v "%cd%/app:/app" -p 5173:5173 -w /app hello-vite /bin/sh


