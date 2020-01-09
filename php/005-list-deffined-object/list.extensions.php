<?php

echo "<pre>";

echo "<h1>get_loaded_extensions</h1>";
$extensions = get_loaded_extensions();
print_r($extensions);

foreach($extensions as $name) {
    echo "<h1>extnsion functions: $name</h1>";
    print_r(get_extension_funcs( $name));
}

echo "</pre>";