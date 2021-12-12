<?php

# ?? how implement this 

#[Attribute]
class MyAttribute1
{
    public $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
}

#[Attribute]
class MyAttribute2
{
    public $value1;
    public $value2;

    public function __construct($value1, $value2)
    {
        $this->value1 = $value1;
        $this->value2 = $value2;
    }
}

class User
{
    #[MyAttribute2( //multiple attributes in one
        new MyAttribute1(1),
        new MyAttribute1(2)
    )]
    public string $name = '';
}


function dumpAttributeData($reflection) {
    foreach ($reflection->getProperties() as $property) { // get all object properties
        $attributes = $property->getAttributes();

        if (count($attributes) > 0) {
            foreach ($attributes as $attribute) {
               var_dump([$attribute, $attribute->getArguments(), $attribute->newInstance()]);
            }
        }
    }
}


dumpAttributeData(new ReflectionClass(User::class));


