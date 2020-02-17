navigator.geolocation.coordinates
navigator.geolocation.position
navigator.geolocation.positionError
navigator.geolocation.positionOptions
navigator.geolocation.clearWatch()
navigator.geolocation.getCurrentPosition()
navigator.geolocation.watchPosition()

navigator.geolocation.getCurrentPosition(function(position) {
  console.log("Latitude: " + position.coords.latitude +  ", Longitude: " + position.coords.longitude)
});