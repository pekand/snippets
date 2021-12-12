<?php

# https://www.php.net/manual/en/migration81.new-features.php#migration81.new-features.core.octal-literal-prefix

var_dump(016 === 16); // false 
var_dump(016 === 14); // true

var_dump(0o16 === 16); // false 
var_dump(0o16 === 14); // true
