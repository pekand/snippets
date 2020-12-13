<?php

echo '<pre>';

echo '<h1>Constructor property promotion</h1>';

class Point {
    
  public function __construct(public float $x = 0.0, public float $y = 0.0, public float $z = 0.0,) {

  }

  public function print() {
    echo '['.$this->x.' '.$this->y.' '.$this->z.']'."\n";
  }
}

$p = new Point(1, 2, 3);
$p->print();
