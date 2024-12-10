FROM node:23-alpine
RUN apk update && apk add git && rm -rf /var/lib/apt/lists/*
WORKDIR /app
COPY ./app/package*.json ./
RUN npm install
COPY ./app .
EXPOSE 3000
CMD ["npm", "run", "dev"]

