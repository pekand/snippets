<?php


//Poedit https://poedit.net/

echo "<pre>";


$language = "en_US.UTF-8";
$results = putenv("LANG=" . $language); 
if (!$results) {
    exit ('putenv failed');
}

$results = putenv("LC_ALL=$language");
if (!$results) {
    exit ('putenv failed');
}

$results = setlocale(LC_ALL, $language);
if (!$results) {
    exit ('setlocale failed: locale function is not available on this platform, or the given local does not exist in this environment'.PHP_EOL);
}


$domain = "messages";
$results = bindtextdomain($domain, __DIR__."\\locale");
echo 'new text domain is set: ' . $results. "\n";

$results = textdomain($domain);
echo 'current message domain is set: ' . $results. "\n";

bind_textdomain_codeset($domain, 'UTF-8');

echo gettext("HELLO_WORLD");

echo _("HELLO_WORLD");
