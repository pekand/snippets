<?php

echo "<pre><h1>get_resource_id</h1>";

$handle = fopen('application.log', 'w');

echo (int) $handle . "\n";

echo get_resource_id($handle) . "\n";

echo get_resource_type($handle) . "\n";
