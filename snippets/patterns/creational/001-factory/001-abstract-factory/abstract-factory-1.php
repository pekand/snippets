<?php

/* 
    store object constructions in factory
    Factory can have multiple implementations
    Change object creation in object by inserting other factory
*/


interface WriterFactory
{
    public function createCsvWriter(): CsvWriter;
    public function createJsonWriter(): JsonWriter;
}

interface CsvWriter
{
    public function write(array $lines): string;
}

interface JsonWriter
{
    public function write(array $data, bool $formatted): string;
}

class UnixCsvWriter implements CsvWriter
{
    public function write(array $lines): string
    {
        $out = '';
        foreach ($lines as $line) {
            $out .= join(',', $line) . "\n";
        }
        return $out . "\n";
    }
}

class UnixJsonWriter implements JsonWriter
{
    public function write(array $data, bool $formatted): string
    {
        $options = 0;

        if ($formatted) {
            $options = JSON_PRETTY_PRINT;
        }

        return json_encode($data, $options) . "\n";
    }
}

class UnixWriterFactory implements WriterFactory
{
    public function createCsvWriter(): CsvWriter
    {
        return new UnixCsvWriter();
    }

    public function createJsonWriter(): JsonWriter
    {
        return new UnixJsonWriter();
    }
}

class WinCsvWriter implements CsvWriter
{
    public function write(array $lines): string
    {
        $out = '';
        foreach ($lines as $line) {
            $out .= join(',', $line) . "\r\n";
        }
        return $out . "\r\n";
    }
}

class WinJsonWriter implements JsonWriter
{
    public function write(array $data, bool $formatted): string
    {
        return json_encode($data, JSON_PRETTY_PRINT) . "\r\n";
    }
}

class WinWriterFactory implements WriterFactory
{
    public function createCsvWriter(): CsvWriter
    {
        return new WinCsvWriter();
    }

    public function createJsonWriter(): JsonWriter
    {
        return new WinJsonWriter();
    }
}

function writeData(WriterFactory $writerFactory, $data)
{
    $jsonWriter = $writerFactory->createJsonWriter();
    echo $jsonWriter->write($data, true);

    $csvWriter = $writerFactory->createCsvWriter();
    echo $csvWriter->write($data);
}

$data = [
    ['1','2','3','4'],
    ['5','6','7','8'],
];

$unixWriter = new UnixWriterFactory();
writeData($unixWriter, $data);

$winWriter = new WinWriterFactory();
writeData($winWriter, $data);
