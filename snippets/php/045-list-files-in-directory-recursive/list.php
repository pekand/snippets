<?php

function listDir($dir) {
    $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    $paths = array(); 

    $filesByextensions = [];

    foreach ($rii as $file) {

        if ($file->isDir()){ 
            continue;
        }

        $paths[] = [
            'path' => realpath($file->getPathname()),
            'dir' => $file->isDir(),
            'ext' => !$file->isDir() ? strtolower(pathinfo($file->getPathname(), PATHINFO_EXTENSION)) : '',
        ];

    }

    return $paths;
}

$paths = listDir('.');

var_dump($paths);

$byExtension = [];

foreach($paths as $path) {
    if($path['dir'] || $path['ext'] == ''){
        continue;
    }

    if(!isset($byExtension[$path['ext']])) {
        $byExtension[$path['ext']] = 0;
    }
    
    $byExtension[$path['ext']] += 1;
}


arsort($byExtension, krsort($byExtension));

foreach($byExtension as $ext => $count) {
    echo "$ext = $count\n";
}

