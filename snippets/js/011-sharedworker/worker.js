var connections = 0; // count active connections

var data = "a";

self.addEventListener("connect", function (e) {

	var port = e.ports[0];
	connections++;

	data += "a";
	
	port.addEventListener("message", function (e) {
		port.postMessage(data + e.data);
		console.log('test');
	}, false);

	port.start();

}, false);