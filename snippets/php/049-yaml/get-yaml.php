<?php

include 'vendor/autoload.php';
use Symfony\Component\Yaml\Yaml;

$data = Yaml::parseFile('file.yaml');

var_dump($data);

$yaml = Yaml::dump($data);

file_put_contents('file-out.yaml', $yaml);
