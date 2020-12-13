<?php

echo "<pre><h1>Saner string to number comparisons</h1>";


print_r(0 == 'not number' ? 'TRUE' : 'FALSE'); // is false becouse 'not number' is not converted to 0 (in php 7 is true)
