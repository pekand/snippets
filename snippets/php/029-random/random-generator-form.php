<?php

echo '<html lang="en"><meta charset="utf-8"><title>Random string generator form</title><h1>Random string generator form</h1>';

$length = isset($_GET['length']) ? (int)$_GET['length'] : 32;
$seed_random = isset($_GET['seed_random']) ? (int)(bool)$_GET['seed_random'] : 1;
$seed = isset($_GET['seed']) && !$seed_random ? (int)$_GET['seed'] : random_int(PHP_INT_MIN, PHP_INT_MAX);
$count = isset($_GET['count']) ? (int)$_GET['count'] : 10;

$seed_random_checked = $seed_random ? 'checked' : '';

$ch = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';


echo '<form action="" method="GET">
lenth:
<input type="text" name="length" width="300" style="width:500px;" value="'.$length.'"><br>
seed:
<input type="text" name="seed" width="300" style="width:500px;" value="'.$seed.'"><br>
Use random seed:
<input type="hidden" name="seed_random" value="'.$seed_random.'"><input type="checkbox" onclick="this.previousSibling.value=this.checked?1:0" '.$seed_random_checked.'  ><br>
Count:
<input type="text" name="count" style="width:500px;" value="'.$count.'"><br>
<input type="submit">
</form>';


echo '
    <style>
    *{font-family:monospace;}
    </style>
';
mt_srand($seed);
for($c = 0; $c < $count; $c++){
    $out = '';
    for($i=0;$i<$length;$i++) {
        $out  .= $ch[mt_rand(0,strlen($ch)-1)];
    }

    echo $out."<br>".PHP_EOL;
}

