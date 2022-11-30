<?php

include "vendor/autoload.php";
use Seld\JsonLint\JsonParser;

$parser = new JsonParser();

$json = file_get_contents("data.json");

$parser->parse($json);
