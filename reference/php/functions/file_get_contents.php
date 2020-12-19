<?php

echo "<pre>";

$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"Accept-language: en\r\n" .
              "Cookie: foo=bar\r\n"
  )
);

$context = stream_context_create($opts);

$fileContent = file_get_contents(
    'http://www.google.com/', 
    false, //use_include_path (default false)
    $context, // context (default null)
    15, // offset
    100 // maxlen
);

echo htmlspecialchars($fileContent);
