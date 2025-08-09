<?php
function deleteDirectory($dir) {
    if (!is_dir($dir)) return;
    $items = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::CHILD_FIRST
    );
    foreach ($items as $item) {
        if ($item->isDir()) {
            rmdir($item->getPathname());
        } else {
            unlink($item->getPathname());
        }
    }
    rmdir($dir);
}

$force = in_array('--force', $argv);

$root = getcwd();
$directoriesToDelete = [];

$rii = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($root, RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST
);

foreach ($rii as $file) {
    if ($file->isDir()) {
        $name = $file->getFilename();
        if ($name === 'vendor') {
            $projectDir = dirname($file->getPathname());
            $hasComposer = file_exists($projectDir . '/composer.json');
            
            if ($hasComposer) {
                $directoriesToDelete[] = $file->getPathname();
            }
        } else if ($name === 'node_modules') {
            $projectDir = dirname($file->getPathname());
            $hasPackage = file_exists($projectDir . '/package.json');
            
            if ($hasPackage) {
                $directoriesToDelete[] = $file->getPathname();
            }
        }
    }
}


if (!$force) {
    echo "Dry run mode — no directories will be deleted.\n";
    echo "Run this script with --force to actually delete the directories.\n\n";
    foreach ($directoriesToDelete as $dir) {
        echo "Would delete: $dir\n";
    }
    echo "\nFound " . count($directoriesToDelete) . " directories matching criteria.\n";
} else {
    foreach ($directoriesToDelete as $dir) {
        echo "Deleting: $dir\n";
        deleteDirectory($dir);
    }
    echo "Done. Deleted " . count($directoriesToDelete) . " directories.\n";
}

echo "Done. Deleted " . count($directoriesToDelete) . " directories.\n";
