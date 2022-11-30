<?php

include "vendor/autoload.php";
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

$yaml = file_get_contents("data.yaml");

try {
    $value = Yaml::parse($yaml);
} catch (ParseException $exception) {
    printf('Unable to parse the YAML string: %s', $exception->getMessage());
}
