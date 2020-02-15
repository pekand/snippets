<?php

declare(encoding = "UTF-8"); // must by on top of file; for whole file

declare(encoding = "UTF-8") { // for block
    // script
}

declare(ticks=1): // for block
    // script
enddeclare;

echo "zend.multibyte=".ini_get("zend.multibyte").PHP_EOL; // chceck if can be encoding changed

