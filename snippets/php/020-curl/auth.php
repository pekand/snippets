<?php

if (
    !isset($_SERVER['PHP_AUTH_USER']) || 
    !isset($_SERVER['PHP_AUTH_PW']) ||
    $_SERVER['PHP_AUTH_USER'] !== 'username' ||
    $_SERVER['PHP_AUTH_PW'] !== 'password'
) {
    header('WWW-Authenticate: Basic realm="Access to the staging site", charset="UTF-8"');
    header('HTTP/1.0 401 Unauthorized');
    echo '<p>Access denied.</p>';
    exit;
}

echo '<p>Access granted.</p>';



