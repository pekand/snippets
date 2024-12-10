FROM node:23-alpine
RUN apk update && apk add git && rm -rf /var/lib/apt/lists/*
WORKDIR /app
COPY ./app/package*.json ./
RUN npm install -g @angular/cli && npm install
COPY ./app .
EXPOSE 4200
CMD ["ng", "serve", "--host", "0.0.0.0"]

