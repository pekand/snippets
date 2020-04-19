<?php

// abstract factory implementet with static method

interface Formatter
{
    public function format(string $input): string;
}

class FormatString implements Formatter
{
    public function format(string $input): string
    {
        return $input;
    }
}

class FormatNumber implements Formatter
{
    public function format(string $input): string
    {
        return number_format((int)$input);
    }
}

final class FormatFactory
{
    public static function formatter(string $type): Formatter
    {
        if ($type == 'number') {
            return new FormatNumber();
        } elseif ($type == 'string') {
            return new FormatString();
        }

        throw new InvalidArgumentException('Unknown format given');
    }
}

echo FormatFactory::formatter('number')->format(1) . " " . FormatFactory::formatter('string')->format('text');
