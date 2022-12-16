<?php

$descriptorspec = array(
   0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
   1 => array("pipe", "w"),  // stdout is a pipe that the child will write to
   2 => array("pipe", "w")   // stderr is a file to write to
);


$env = ['some_option' => 'aeiou'];

//PHP_BINARY
$process = proc_open(" php child.php", $descriptorspec, $pipes, null, $env);

if (!is_resource($process)) {
     echo "ERROR\n";
     die();
}

// $pipes now looks like this:
// 0 => writeable handle connected to child stdin
// 1 => readable handle connected to child stdout
// Any error output will be appended to /tmp/error-output.txt

$i = 5;
while ($i-->=0) {
     fwrite($pipes[0], "test1\n");
     echo stream_get_contents($pipes[1]);
     sleep(1);
}

fclose($pipes[0]);
fclose($pipes[1]);

// It is important that you close any pipes before calling
// proc_close in order to avoid a deadlock
$return_value = proc_close($process);

echo "command returned $return_value\n";
