<?php 

# https://www.php.net/manual/en/language.oop5.final.php#language.oop5.final.example.php81

class Parent1
{
    final public const CONSTANT1 = "foo";
}

class Child1 extends Parent1
{
    public const CONSTANT1 = "bar"; // cant ovveride final constant > Fatal error
}
