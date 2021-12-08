<?php
$runtime1 = new \parallel\Runtime();
$runtime2= new \parallel\Runtime();

$future = $runtime1->run(function(){
    for ($i = 0; $i < 20; $i++) {
        echo "*";
        usleep(100000);
    }

    return "easy1";
});

$future2 = $runtime2->run(function(){
    for ($i = 0; $i < 20; $i++) {
        echo "@";
        usleep(100000);
    }

    return "easy2";
});

for ($i = 0; $i < 100; $i++) {
    echo ".";
    usleep(100000);
}

printf("\nUsing \\parallel\\Runtime is %s\n", $future->value());
printf("\nUsing \\parallel\\Runtime is %s\n", $future2->value());
