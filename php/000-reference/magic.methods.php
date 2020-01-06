<?php

echo "<pre>";

class ClassBase {
    function __construct() {
        echo "constructor ";
    }

    function __destruct() {
        echo "destructor";
    }
}

$o = new ClassBase();
unset($o);

echo "<hr>";

class ClasssString {
    public function __toString()
    {
        return "value ";
    }
}

$o = new ClasssString();
echo $o;
echo (string)$o;

echo "<hr>";

class CallableClass
{
    public function __invoke($p)
    {
        var_dump($p);
    }
}
$obj = new CallableClass;
$obj(5);
var_dump(is_callable($obj));

echo "<hr>";

class ClasssSerialize {
    public $a = null;
    public $b = null;

    public function __sleep()
    {
        return ['a']; // skip parameter b in serialization (list of paramaters for serialization)
    }
    
    public function __wakeup() // after unserialization call this function (for example connect to database after object restored)
    {
        $this->b = 1; 
    }
}

$o = new ClasssSerialize();
$o->a=2;
$o->b=3;
print_r($o);

echo "<br>";
$out = serialize($o);
echo htmlspecialchars($out);

echo "<br>";
$o = unserialize($out);
print_r($o);

echo "<hr>";

class ClasssExport {
    private $a = 1;
    public $b = 2;

    public static function __set_state($a) // var_export generated code need expect for object this function
    {
        $o = new ClasssExport;
        $o->a = $a['a'];
        $o->b = $a['b'];
        return $o;
    }
}

$o = new ClasssExport();
$out = var_export($o, true);
var_dump($out);

/*
generated code (expect __set_state in object for restore object state):

ClasssExport::__set_state(array(
    'a' => 1,
    'b' => 2,
 ))

*/

$o2 = eval("return ".$out.";");

var_dump($o2);

echo "<hr>";

class ClassCall {
    public function __call($name, $arguments)
    {
        var_dump($name, $arguments);
    }

    public static function __callStatic($name, $arguments)
    {
        var_dump($name, $arguments);
    }
}

ClassCall::runStatic(1,2,3);
$o = new ClassCall();
$o->run(1,2,3);

echo "<hr>";

class ClassSet {

    private $data = [];

    public function __set($name , $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        return $this->data[$name];
    }

    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    public function __unset($name)
    {
        unset($this->data[$name]);
    }
}


$o = new ClassSet();
$o->param = "value";
if(isset($o->param)){
    var_dump($o->param);
    unset($o->param);
}

echo "<hr>";

class ClassDebug {
    public $a = 1; // hidden
    public function __debugInfo()
    {
        return ['param' => "debug info"];
    }
}

$o = new ClassDebug();
var_dump($o);
print_r($o);
var_export($o);
