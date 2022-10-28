<?php

$pid = pcntl_fork();
if ($pid == -1) {
     die('could not fork');
} else if ($pid) {     
     echo "parent\n";
     pcntl_wait($status);
     echo "parent\n";
} else {
     echo "child\n";
}
