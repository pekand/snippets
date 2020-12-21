<?php

$protocol = $_SERVER["SERVER_PROTOCOL"];

// https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers

header($protocol." 100 Continue");
header($protocol." 101 Switching Protocols");
header($protocol." 103 Early Hints");
header($protocol." 200 OK");
header($protocol." 201 Created");
header($protocol." 202 Accepted");
header($protocol." 203 Non-Authoritative Information");
header($protocol." 204 No Content");
header($protocol." 205 Reset Content");
header($protocol." 206 Partial Content");
header($protocol." 300 Multiple Choices");
header($protocol." 301 Moved Permanently");
header($protocol." 302 Found");
header($protocol." 303 See Other");
header($protocol." 304 Not Modified");
header($protocol." 307 Temporary Redirect");
header($protocol." 308 Permanent Redirect");
header($protocol." 400 Bad Request");
header($protocol." 401 Unauthorized");
header($protocol." 402 Payment Required");
header($protocol." 403 Forbidden");
header($protocol." 404 Not Found");
header($protocol." 405 Method Not Allowed");
header($protocol." 406 Not Acceptable");
header($protocol." 407 Proxy Authentication Required");
header($protocol." 408 Request Timeout");
header($protocol." 409 Conflict");
header($protocol." 410 Gone");
header($protocol." 411 Length Required");
header($protocol." 412 Precondition Failed");
header($protocol." 413 Payload Too Large");
header($protocol." 414 URI Too Long");
header($protocol." 415 Unsupported Media Type");
header($protocol." 416 Range Not Satisfiable");
header($protocol." 417 Expectation Failed");
header($protocol." 418 I'm a teapot");
header($protocol." 422 Unprocessable Entity");
header($protocol." 425 Too Early");
header($protocol." 426 Upgrade Required");
header($protocol." 428 Precondition Required");
header($protocol." 429 Too Many Requests");
header($protocol." 431 Request Header Fields Too Large");
header($protocol." 451 Unavailable For Legal Reasons");
header($protocol." 500 Internal Server Error");
header($protocol." 501 Not Implemented");
header($protocol." 502 Bad Gateway");
header($protocol." 503 Service Unavailable");
header($protocol." 504 Gateway Timeout");
header($protocol." 505 HTTP Version Not Supported");
header($protocol." 506 Variant Also Negotiates");
header($protocol." 507 Insufficient Storage");
header($protocol." 508 Loop Detected");
header($protocol." 510 Not Extended");
header($protocol." 511 Network Authentication Required");

die();

header("Location: https://google.com");

header("refresh:5;url=wherever.php" ); 

header("Cache-Control: no-cache, must-revalidate");
header("Expires: ".gmdate('D, d M Y H:i:s T')); // Sat, 26 Jul 1997 05:00:00 GMT

$dt = new DateTime('2013-01-01 12:00:00', new DateTimezone('UTC'));
header("Expires: ".$dt->format('D, d M Y H:i:s \G\M\T'));

header('Content-Type: application/javascript');
header('Content-Type: application/pdf');
header('Content-Type: application/xhtml+xml');
header('Content-Type: application/json  ');
header('Content-Type: application/xml');
header('Content-Type: application/zip  ');
header('Content-Type: application/x-www-form-urlencoded');
header('Content-Type: audio/mpeg');
header('Content-Type: audio/x-wav');
header('Content-Type: image/gif');
header('Content-Type: image/jpeg');
header('Content-Type: image/png');
header('Content-Type: image/tiff');
header('Content-Type: image/x-icon');
header('Content-Type: image/svg+xml ');
header('Content-Type: multipart/mixed ');
header('Content-Type: multipart/alternative');
header('Content-Type: multipart/form-data');
header('Content-Type: text/css ');
header('Content-Type: text/csv ');
header('Content-Type: text/html    ');
header('Content-Type: text/plain ');
header('Content-Type: text/xml ');
header('Content-Type: video/mpeg ');
header('Content-Type: video/mp4 ');
header('Content-Type: video/x-ms-wmv ');
header('Content-Type: video/x-msvideo ');
header('Content-Type: video/x-flv');
header('Content-Type: video/webm');
