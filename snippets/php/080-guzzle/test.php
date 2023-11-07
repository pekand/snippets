<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ConnectException;

$client = new Client();

try {
    $response = $client->request('POST', 'http://127.0.0.1:8000/test/response500', [
        'json' => [
            'key1' => 'value1',
            'key2' => 'value2',
        ],
        'headers' => [
            'Content-Type' =>' application/json',
        ],
    ]);

    // Get the status code and body of the response
    $statusCode = $response->getStatusCode();
    $body = $response->getBody()->getContents();

    // Do something with the response
    var_dump($statusCode);
    var_dump($body);

} catch (ClientException $e) {
    var_dump('ClientException:::'.$e->getMessage());
} catch (ServerException $e) {
    var_dump('ServerException:::'.$e->getMessage());
} catch (ConnectException $e) {
    var_dump('ClientException:::'.$e->getMessage());
} catch (GuzzleException $e) {
    var_dump('GuzzleException:::'.$e->getMessage());
}
