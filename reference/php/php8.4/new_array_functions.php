<?php


$animal = array_find(
    ['dog', 'cat', 'cow', 'duck', 'goose'],
    static fn (string $value): bool => str_starts_with($value, 'c'),
);

var_dump($animal); // string(3) "cat"

// array_find — Returns the first element satisfying a callback function
// array_find(array $array, callable $callback) 

// Returns the key of the first element satisfying a callback function
// array_find_key(array $array, callable $callback) 

// Checks if at least one array element satisfies a callback function
// array_any(array $array, callable $callback)

// Checks if all array elements satisfy a callback function
// array_all(mixed $value, mixed $key)