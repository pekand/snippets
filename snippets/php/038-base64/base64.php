<?php




$path = 'image.png';
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$image = 'data:image/' . $type . ';base64,' . base64_encode($data);

echo "<html><img src=\"$image\">";
