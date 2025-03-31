
dotnet new web -o HelloWorldApp

docker build -t dotnet-app-img .
docker run --rm -it --name dotnet-app -p 9000:8080 dotnet-app-img
http://127.0.0.1:9000/