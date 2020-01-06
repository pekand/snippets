<?php
echo "<pre>";

class Subclass {
    public $a = [1, 2, 3];
}

class Test {
    private $s = null;
    public $a = [1, 2, 3];

    function __construct(){
        $this->s = new Subclass();
    }
}
echo "<hr>";

$o = new Test();
$out = serialize($o);
echo htmlspecialchars($out);

echo "<hr>";

$o = unserialize($out);
print_r($o);
echo "unserialized object type:".(get_class($o));

echo "<hr>";

$o = unserialize($out, ['allowed_classes' => false]);
print_r($o);
echo "unserialized object type:".(get_class($o));