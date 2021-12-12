<?php

echo "<pre><h1>Attributes</h1>";

#[Attribute]
class SetUp {}

#[Attribute]
class MyAttribute
{
    public $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
}

#[MyAttribute(value: 1234)]
class Thing
{

    #[MyAttribute(value: 7890)]
    public string $text = "";

    #[SetUp]
    #[MyAttribute(value: 3456)]
    public function fileExists()
    {
        if (!file_exists($this->fileName)) {
            throw new RuntimeException("File does not exist");
        }
    }
}

function dumpAttributeData($reflection) {
    $attributes = $reflection->getAttributes();

    foreach ($attributes as $attribute) {
       var_dump([$attribute, $attribute->getArguments(), $attribute->newInstance()]); // get object atributes
    }

    foreach ($reflection->getProperties() as $property) { // get all object properties
        $attributes = $property->getAttributes();

        if (count($attributes) > 0) {
            foreach ($attributes as $attribute) {
               var_dump([$attribute, $attribute->getArguments(), $attribute->newInstance()]);
            }
        }
    }

    foreach ($reflection->getMethods() as $method) { // get all atributes
        $attributes = $method->getAttributes();
        //$attributes = $method->getAttributes(SetUp::class); // select only specific atribute

        if (count($attributes) > 0) {
            foreach ($attributes as $attribute) {
               var_dump([$attribute, $attribute->getArguments(), $attribute->newInstance()]);
            }
        }
    }
}

dumpAttributeData(new ReflectionClass(Thing::class));
