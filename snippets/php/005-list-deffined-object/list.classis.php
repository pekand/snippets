<?php

echo "<pre>";

echo "<h1>get_declared_classes</h1>";
$classes = get_declared_classes();
print_r($classes);

foreach($classes as $name) {
   
    echo "<h1>class methods: $name</h1>";
    print_r(get_class_methods($name));
}

echo "</pre>";