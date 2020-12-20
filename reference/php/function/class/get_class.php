<?php

namespace CustomNamespace;

echo "<pre>";



class ClassName {
}

$obj = new ClassName();

echo get_class($obj).PHP_EOL; // -> CustomNamespace\ClassName
