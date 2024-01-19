<?php

// OLD

// This function needs to be manually implemented.
function getBytesFromString(string $string, int $length) {
    $stringLength = strlen($string);

    $result = '';
    for ($i = 0; $i < $length; $i++) {
        // random_int is not seedable for testing, but secure.
        $result .= $string[random_int(0, $stringLength - 1)];
    }

    return $result;
}

$randomDomain = sprintf(
    "%s.example.com",
    getBytesFromString(
        'abcdefghijklmnopqrstuvwxyz0123456789',
        16,
    ),
);

echo $randomDomain;


// NEW 8.3

// A \Random\Engine may be passed for seeding,
// the default is the secure engine.
$randomizer = new \Random\Randomizer();

$randomDomain = sprintf(
    "%s.example.com",
    $randomizer->getBytesFromString(
        'abcdefghijklmnopqrstuvwxyz0123456789',
        16,
    ),
);

echo $randomDomain;

// The Random Extension that was added in PHP 8.2 was extended by a new method to generate random strings consisting of specific bytes only. This method allows the developer to easily generate random identifiers, such as domain names, and numeric strings of arbitrary length. 

