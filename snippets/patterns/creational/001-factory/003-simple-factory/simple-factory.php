<?php

// deleate object creation to factory object

class PrintJson
{
    public function format(array $data)
    {
        return json_encode($data, JSON_PRETTY_PRINT);
    }
}

class DataFormatterFactory
{
    public function createPrinter(): PrintJson
    {
        return new PrintJson();
    }
}

$factory = new DataFormatterFactory();
$jsonPrinter = $factory->createPrinter();

echo $jsonPrinter->format(['attribute' => 'value']);
