<?php
require 'vendor/autoload.php';

use Elastic\Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()
    ->setHosts(['http://elasticsearch:9200'])
    ->setBasicAuthentication('elastic', 'mysecretpassword')
    ->setSSLVerification(false)
    ->build();

// Index a document
$params = [
    'index' => 'test_index',
    'id'    => '1',
    'body'  => ['title' => 'Hello World']
];

$response = $client->index($params);
print_r($response);

// Get the document
$getParams = ['index' => 'test_index', 'id' => '1'];
$response = $client->get($getParams);
print_r($response);