<?php

// OLD

// Returns a random float between $min and $max, both including.
function getFloat(float $min, float $max) {
    // This algorithm is biased for specific inputs and may
    // return values outside the given range. This is impossible
    // to work around in userland.
    $offset = random_int(0, PHP_INT_MAX) / PHP_INT_MAX;

    return $offset * ($max - $min) + $min;
}

$temperature = getFloat(-89.2, 56.7);

$chanceForTrue = 0.1;
// getFloat(0, 1) might return the upper bound, i.e. 1,
// introducing a small bias.
$myBoolean = getFloat(0, 1) < $chanceForTrue;


// NEW 8.3

$randomizer = new \Random\Randomizer();

$temperature = $randomizer->getFloat(
    -89.2,
    56.7,
    \Random\IntervalBoundary::ClosedClosed,
);

$chanceForTrue = 0.1;
// Randomizer::nextFloat() is equivalent to
// Randomizer::getFloat(0, 1, \Random\IntervalBoundary::ClosedOpen).
// The upper bound, i.e. 1, will not be returned.
$myBoolean = $randomizer->nextFloat() < $chanceForTrue;


// Due to the limited precision and implicit rounding of floating point numbers, generating an unbiased float lying within a specific interval is non-trivial and the commonly used userland solutions may generate biased results or numbers outside the requested range.

// The Randomizer was also extended with two methods to generate random floats in an unbiased fashion. The Randomizer::getFloat() method uses the γ-section algorithm that was published in Drawing Random Floating-Point Numbers from an Interval. Frédéric Goualard, ACM Trans. Model. Comput. Simul., 32:3, 2022.
