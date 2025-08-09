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

$root = getcwd();
$directoriesToDelete = [];

// Step 1: Find all matching dirs first
$rii = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($root, RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST
);

foreach ($rii as $file) {
    if ($file->isDir()) {
        $name = $file->getFilename();
        if ($name === 'vendor' || $name === 'node_modules' || $name === 'packages' || $name === 'bin') {
            $directoriesToDelete[] = $file->getPathname();
        }
    }
}

// Step 2: Delete them
foreach ($directoriesToDelete as $dir) {
    echo "Deleting: $dir\n";
    deleteDirectory($dir);
}

echo "Done. Deleted " . count($directoriesToDelete) . " directories.\n";