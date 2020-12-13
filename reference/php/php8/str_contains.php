<?php

echo "<pre><h1>str_contains</h1>";

if(str_contains("Long sentence with word", "word")) {
    echo "yes\n";
}

if(strpos("Long sentence with word", "word") !== false) {
    echo "yes\n";
}

if(strpos("Long sentence with word", "word") !== false) {
    echo "yes\n";
}
