<?php
$search = trim(@$_GET['search']);

if($search == ""){
    die();
}

$it = new RecursiveDirectoryIterator(".");
$extensions = ['txt', 'md', 'html', 'htm', 'js', 'ts',  'css', 'css', 'xml', 'json', 'htaccess', 'sh', 'bat', 'cmd', 'ps1', 'php', 'py', 'pyw', 'twig'];

function scan($search, $extensions, $dir, &$result) {
   $paths = scandir($dir);
   foreach ($paths as $value)
   {
        $path = $dir . DIRECTORY_SEPARATOR . $value;

        if (in_array($value, [".", "..", ".git", ".idea", "node_modules", "vendor"]))
        {
            continue;
        }

        if (in_array($value, [".", "..", ".git", ".idea", "node_modules", "vendor"]))
        {
            continue;
        }

        if (is_dir($path))
        {
            if(str_contains($value, $search)) {
                $result['dir'][] = realpath($path);
            }

            scan($search, $extensions, $path, $result);
        }

        if (is_file($path))
        {
            if(str_contains($value, $search)) {
                $result['file'][] = realpath($path);
            } else if(in_array(pathinfo($path, PATHINFO_EXTENSION), $extensions) && str_contains(file_get_contents($path), $search)) {
                $result['content'][] = realpath($path);
            }
        }
   }
  
}

$result = [];
scan($search, $extensions, '.', $result);

if(isset($result['dir'])) foreach ($result['dir'] as $value) {
    $cwd = realpath(getcwd());
    $path = str_replace($cwd, '.', $value);
    $url = str_replace(DIRECTORY_SEPARATOR, '/',  str_replace($cwd, 'https://snippets.dev', $value));
    echo '<div><a href="'.$url.'">'.$path.'</a></div>';
}

if(isset($result['file'])) foreach ($result['file'] as $value) {
    $cwd = realpath(getcwd());
    $path = str_replace($cwd, '.', $value);
    $url = str_replace(DIRECTORY_SEPARATOR, '/',  str_replace($cwd, 'https://snippets.dev', $value));
    echo '<div><a href="'.$url.'">'.$path.'</a></div>';
}

if(isset($result['content'])) foreach ($result['content'] as $value) {
    $cwd = realpath(getcwd());
    $path = str_replace($cwd, '.', $value);
    $url = str_replace(DIRECTORY_SEPARATOR, '/',  str_replace($cwd, 'https://snippets.dev', $value));
    echo '<div><a href="'.$url.'">'.$path.'</a></div>';
}


?>
