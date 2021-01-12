<?php

echo "<pre>";

$data = isset($_GET['text']) ? $_GET['text'] : rand();

echo '
<form method="get">
<input type="text" name="text" value="'.$data.'">
<input type="submit">
</form>
';



$algOut = [];
foreach (hash_algos() as $alg) {
    $out = hash($alg, $data);
    $algOut[] = ['alg'=>$alg, 'value'=>$out];
}

usort($algOut, function ($a, $b) {
    return strlen($a['value']) <=> strlen($b['value']);
});

echo '
<style>
table, tr, td {border:1px solid black;border-collapse: collapse;}
</style>
';

echo '<table>'.PHP_EOL;
foreach ($algOut as $value) {
    echo '<tr><td>'.$value['alg'].'</td><td>'.strlen($value['value']).'</td><td>'.$value['value'].'</td></tr>'.PHP_EOL;
}
echo '</table>'.PHP_EOL;
