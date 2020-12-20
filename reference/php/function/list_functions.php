<?php

echo "<pre>";


foreach (get_defined_functions()['internal'] as $func) {
    echo $func.PHP_EOL;
}
