<?php
// Set the IP address and port number
$ip_address = '127.0.0.1';
$port = 12345;

// Create a new socket
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

// Connect to the server
socket_connect($socket, $ip_address, $port);

echo "Connected to the server.\n";

// Read the message from the server
$message = socket_read($socket, 1024);

echo "Received message: {$message}\n";

// Close the socket
socket_close($socket);