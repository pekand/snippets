<?php

echo "<pre>";

echo (is_resource(fopen('http://www.google.com', 'r'))?1:0).PHP_EOL;
