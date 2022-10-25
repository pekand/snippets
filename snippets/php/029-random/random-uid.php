<?php


function get($length){
    $seed = random_int(PHP_INT_MIN, PHP_INT_MAX);
    mt_srand($seed); 
    $out = '';
    $ch = '0123456789abcdefghijklmnopqrstuvwxyz';
    for($i=0;$i<$length;$i++) {
        $out  .= $ch[mt_rand(0,strlen($ch)-1)];
    }        

    return $out;
}


//iqa4j2yy-n98l-sknf-lvec-p4o8pcgkjf5h

for($i=0;$i<10;$i++){
    echo get(8).'-'.get(4).'-'.get(4).'-'.get(4).'-'.get(12)."\n";
}

