<?php

echo "<pre>";

$url = 'http://username:password@hostname:9090/path?arg=value#anchor';

echo var_export(parse_url($url), true).PHP_EOL.PHP_EOL;


/*

  array (
    'scheme' => 'http',
    'host' => 'hostname',
    'port' => 9090,
    'user' => 'username',
    'pass' => 'password',
    'path' => '/path',
    'query' => 'arg=value',
    'fragment' => 'anchor',
  )

*/

$data = [
    'var1' => 'value1',
    'arr1' => 
    [
      0 => 'foo bar',
      1 => 'baz',
    ],
];

//////////////////////

echo http_build_query($data).PHP_EOL.PHP_EOL; // var1=value1&arr1%5B0%5D=foo+bar&arr1%5B1%5D=baz

//////////////////////

parse_str("var1=value1&arr1[]=foo+bar&arr1[]=baz", $output);
echo var_export($output, true);

/*

  array (
    'var1' => 'value1',
    'arr1' => 
    array (
      0 => 'foo bar',
      1 => 'baz',
    ),
  )

*/
