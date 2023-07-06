<?php

unlink("stream.in");
unlink("stream.out");
unlink("stream.err");

touch("stream.in");
touch("stream.out");
touch("stream.err");

fwrite(STDOUT, "out\n");
fwrite(STDERR, "error\n");

flush();

fclose(STDIN);
fclose(STDOUT);
fclose(STDERR);
$STDIN =  fopen("stream.in", 'r');
$STDOUT = fopen("stream.out", 'ab');
$STDERR = fopen("stream.err", 'ab');

fwrite($STDOUT, "out\n");
fwrite($STDERR, "error\n");

echo "1234";
flush();

