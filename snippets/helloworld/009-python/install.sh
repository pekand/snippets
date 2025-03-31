docker build -t flask-docker-app .
docker run -rm -it --name flask-app -p 5000:5000 flask-docker-app
http://127.0.0.1:5000/