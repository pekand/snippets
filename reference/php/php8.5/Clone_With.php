<?php

/*
	Clone With
	It is now possible to update properties during object cloning by passing an associative array to the clone() function. This enables straightforward support of the "with-er" pattern for readonly classes.
*/

// PHP 8.5

readonly class Color1
{
    public function __construct(
        public int $red,
        public int $green,
        public int $blue,
        public int $alpha = 255,
    ) {}

    public function withAlpha(int $alpha): self
    {
        return clone($this, [
            'alpha' => $alpha,
        ]);
    }
}

$blue = new Color1(79, 91, 147);
$transparentBlue = $blue->withAlpha(128);

// PHP 8.4

readonly class Color2
{
    public function __construct(
        public int $red,
        public int $green,
        public int $blue,
        public int $alpha = 255,
    ) {}

    public function withAlpha(int $alpha): self
    {
        $values = get_object_vars($this);
        $values['alpha'] = $alpha;

        return new self(...$values);
    }
}

$blue = new Color2(79, 91, 147);
$transparentBlue = $blue->withAlpha(128);

