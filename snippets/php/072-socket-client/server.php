<?php
// Set the IP address and port number
$ip_address = '127.0.0.1';
$port = 12345;

// Create a new socket
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

// Bind the socket to the IP address and port
socket_bind($socket, $ip_address, $port);

// Listen for incoming connections
socket_listen($socket);

echo "Waiting for a connection...\n";

// Accept an incoming connection
$client_socket = socket_accept($socket);

echo "Client connected.\n";

// The message to send
$message = "Hello from the server!";

// Send the message to the client
socket_write($client_socket, $message, strlen($message));

// Close the client socket
socket_close($client_socket);

// Close the server socket
socket_close($socket);