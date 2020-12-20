<?php

goto a;
    echo "skip";
a:

while($b) {
}

while (true):
endwhile;

do {
} while (true);

for($i=0;$i<10;$i++) {
}

for($i=0;$i<10;$i++) {
    for($j=0;$j<10;$j++) {
        break;  
        break 1; // end inner for
        break 2;  // end outer for
        continue;
    }
}

for ($i=0;$i<10;$i++):
endfor; 

$a = [1, 2, 3];
foreach($a as $v) {
} 

foreach($a as $key => $value) {
} 

foreach($a as $v):
endforeach;  
