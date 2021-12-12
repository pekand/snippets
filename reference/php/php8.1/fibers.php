<?php

# https://www.php.net/manual/en/language.fibers.php

# ?? how implement this

$files = [
    'src/foo.png' => 'dest/foo.png',
    'src/bar.png' => 'dest/bar.png',
    'src/baz.png' => 'dest/baz.png',
];

$fiber = new Fiber(function(array $files): void {
    foreach($files as $source => $destination) {
      
        // do some action whitch is splitable to small parts   
        //copy($source, $destination);
        var_dump(["action"=>"copy", "source"=>$source, "destination"=>$destination]);

        Fiber::suspend([$source, $destination]); // return to parent event loop 
    }
});

// Pass the files list into Fiber.
$copied = $fiber->start($files);
$copied_count = 1;
$total_count  = count($files);

while(!$fiber->isTerminated()) {
    $percentage = round($copied_count / $total_count, 2) * 100;
    var_dump("[{$percentage}%]: Copied '{$copied[0]}' to '{$copied[1]}'");
    $copied = $fiber->resume(); // return to fiber event loop
    ++$copied_count;
}

var_dump('Completed');
