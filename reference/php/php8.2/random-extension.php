<?php

use Random\Engine\Xoshiro256StarStar;
use Random\Randomizer;

$blueprintRng = new Xoshiro256StarStar(
    hash('sha256', "Example seed that is converted to a 256 Bit string via SHA-256", true)
);

$fibers = [];
for ($i = 0; $i < 8; $i++) {
    $fiberRng = clone $blueprintRng;
    // Xoshiro256**'s 'jump()' method moves the blueprint ahead 2**128 steps, as if calling
    // 'generate()' 2**128 times, giving the Fiber 2**128 unique values without needing to reseed.
    $blueprintRng->jump();

    $fibers[] = new Fiber(function () use ($fiberRng, $i): void {
        $randomizer = new Randomizer($fiberRng);

        echo "{$i}: " . $randomizer->getInt(0, 100), PHP_EOL;
    });
}

// The randomizer will use a CSPRNG by default.
$randomizer = new Randomizer();

// Even though the fibers execute in a random order, they will print the same value
// each time, because each has its own unique instance of the RNG.
$fibers = $randomizer->shuffleArray($fibers);
foreach ($fibers as $fiber) {
    $fiber->start();
}