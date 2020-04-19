<?php

// storage for entities 
// One entity has several attributes of different kinds
// All entities have a large common set of attributes
// source: https://designpatternsphp.readthedocs.io/en/latest/More/EAV/README.html







class Attribute
{
    private SplObjectStorage $values;
    private string $name;

    public function __construct(string $name)
    {
        $this->values = new SplObjectStorage();
        $this->name = $name;
    }

    public function addValue(Value $value)
    {
        $this->values->attach($value);
    }

    public function getValues(): SplObjectStorage
    {
        return $this->values;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}

class Value
{
    private Attribute $attribute;
    private string $name;

    public function __construct(Attribute $attribute, string $name)
    {
        $this->name = $name;
        $this->attribute = $attribute;

        $attribute->addValue($this);
    }

    public function __toString(): string
    {
        return sprintf('%s: %s', (string) $this->attribute, $this->name);
    }
}

class Entity
{
    private $values;

    private string $name;

    public function __construct(string $name, $values)
    {
        $this->values = new SplObjectStorage();
        $this->name = $name;

        foreach ($values as $value) {
            $this->values->attach($value);
        }
    }

    public function __toString(): string
    {
        $text = [$this->name];

        foreach ($this->values as $value) {
            $text[] = (string) $value;
        }

        return join(', ', $text);
    }
}

$colorAttribute = new Attribute('color'); // attribute has name
$colorSilver = new Value($colorAttribute, 'silver'); // value has attribute
$colorBlack = new Value($colorAttribute, 'black');

$memoryAttribute = new Attribute('memory');
$memory8Gb = new Value($memoryAttribute, '8GB');

$entity = new Entity('Notebook', [$colorSilver, $colorBlack, $memory8Gb]); // entity has values

echo $entity;
