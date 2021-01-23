<?php

$start_memory = memory_get_usage();
echo "Ram usage (MB) = " . ($start_memory) / 1024 / 1024 . PHP_EOL;

$data = [];

for ($i=0; $i < 2000000; $i++) {
    $data[] = [
        'value' => rand()
    ];
}

echo "Ram usage (MB) = " . (memory_get_usage() - $start_memory) / 1024 / 1024;
