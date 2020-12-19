<?php

echo "<pre>";

$count = preg_match_all('/abc/', 'abc abc abc', $matches);
echo $count.PHP_EOL; // -> 3
echo json_encode($matches).PHP_EOL; // -> [["abc","abc","abc"]]

$count = preg_match_all('/(abc)(def)/', 'abcdef abcdef', $matches);
echo $count.PHP_EOL; // -> 2
echo json_encode($matches).PHP_EOL; // -> [["abcdef","abcdef"],["abc","abc"],["def","def"]]

$count = preg_match_all('/(abc)(def)/', 'abcdef abcdef', $matches, PREG_PATTERN_ORDER, 6);
echo $count.PHP_EOL; // -> 1
echo json_encode($matches).PHP_EOL; // -> [["abcdef"],["abc"],["def"]]

preg_match_all('/(abc)(def)/', 'abcdef abcdef', $matches, PREG_PATTERN_ORDER);
echo json_encode($matches).PHP_EOL; // -> [["abcdef","abcdef"],["abc","abc"],["def","def"]]

preg_match_all('/(abc)(def)/', 'abcdef abcdef', $matches, PREG_SET_ORDER);
echo json_encode($matches).PHP_EOL; // -> [["abcdef","abc","def"],["abcdef","abc","def"]]

preg_match_all('/(abc)(def)/', 'abcdef abcdef', $matches, PREG_OFFSET_CAPTURE);
echo json_encode($matches).PHP_EOL; // -> [[["abcdef",0],["abcdef",7]],[["abc",0],["abc",7]],[["def",3],["def",10]]]

preg_match_all('/(abc)(def)/', 'abcdef abcdef', $matches, PREG_SET_ORDER|PREG_OFFSET_CAPTURE);
echo json_encode($matches).PHP_EOL; // -> [[["abcdef",0],["abc",0],["def",3]],[["abcdef",7],["abc",7],["def",10]]]

preg_match_all('/(abc)(def)*(ghi)/', 'abcghi abcghi', $matches);
echo json_encode($matches).PHP_EOL; // -> [["abcghi","abcghi"],["abc","abc"],["",""],["ghi","ghi"]]

preg_match_all('/(abc)(def)*(ghi)/', 'abcghi abcghi', $matches, PREG_UNMATCHED_AS_NULL);
echo json_encode($matches).PHP_EOL; // -> [["abcghi","abcghi"],["abc","abc"],[null,null],["ghi","ghi"]]

