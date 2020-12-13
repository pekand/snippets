<?php

echo "<pre><h1>Stringable interface</h1>";

echo "<p>if class implement __toString is automaticaly implement Stringable</p>";

class A
{
    public function __toString(): string
    {
        return "";
    }
}

$a = new A();

if ($a instanceof Stringable) { 
    echo "is_stringable";
} else {
    echo "is_not_stringable"; 
}
