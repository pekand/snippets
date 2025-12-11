<?php

/*
	array_first() and array_last() functions
	The array_first() and array_last() functions return the first or last value of an array, respectively. If the array is empty, null is returned (making it easy to compose with the ?? operator).
*/

// PHP 8.5
$events = [
    ['id' => 1, 'name' => 'Login'],
    ['id' => 2, 'name' => 'Upload File'],
    ['id' => 3, 'name' => 'Logout'],
];

// Get the first event
$firstEvent = array_first($events);
echo "First event: ";
print_r($firstEvent);

// Get the last event
$lastEvent = array_last($events);
echo "Last event: ";
print_r($lastEvent);

// Example with an empty array
$empty = [];

$firstOrDefault = array_first($empty) ?? 'No events';
$lastOrDefault = array_last($empty) ?? 'No events';

echo "First or default: $firstOrDefault\n";
echo "Last or default: $lastOrDefault\n";

// PHP 8.4
$lastEvent = $events === []
    ? null
    : $events[array_key_last($events)];
