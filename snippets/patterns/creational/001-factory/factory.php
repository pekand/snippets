<?php


// Use multiple constructors to create same object

class Point {

    public static function CartesianPoint(float $x, float $y) {
        return new Point($x, $y);
    }

    public static function PolarPoint(float $rho, float $theta) {
        return new Point($rho * cos($theta), $rho * sin($theta));
    }

    private function __construct(float $x, float $y) { // direct creation of object is prohibited by private keyword
        $this->x = $x;
        $this->y = $y;
    }

    public function __toString()
    {
        return sprintf('[%f,%f]',$this->x, $this->y);
    }
}

$point1 = Point::CartesianPoint(1.0, 2.0);
echo $point1 . "\n";

$point2 = Point::PolarPoint(1.0, pi()/2); 
echo $point2 . "\n";
