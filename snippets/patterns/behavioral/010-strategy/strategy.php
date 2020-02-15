<?php

class Context
{
    private Comparator $comparator;

    public function __construct(Comparator $comparator)
    {
        $this->comparator = $comparator;
    }

    public function executeStrategy(array $elements): array
    {
        uasort($elements, [$this->comparator, 'compare']);

        return $elements;
    }
}

interface Comparator
{
    public function compare($a, $b): int;
}

class DateComparator implements Comparator
{
    public function compare($a, $b): int
    {
        $aDate = new DateTime($a['date']);
        $bDate = new DateTime($b['date']);

        return $aDate <=> $bDate;
    }
}

class IdComparator implements Comparator
{
    public function compare($a, $b): int
    {
        return $a['id'] <=> $b['id'];
    }
}


function provideIntegers()
{
    return [
        [
            [['id' => 2], ['id' => 1], ['id' => 3]],
            ['id' => 1],
        ],
        [
            [['id' => 3], ['id' => 2], ['id' => 1]],
            ['id' => 1],
        ],
    ];
}

function provideDates()
{
    return [
        [
            [['date' => '2014-03-03'], ['date' => '2015-03-02'], ['date' => '2013-03-01']],
            ['date' => '2013-03-01'],
        ],
        [
            [['date' => '2014-02-03'], ['date' => '2013-02-01'], ['date' => '2015-02-02']],
            ['date' => '2013-02-01'],
        ],
    ];
}


$obj = new Context(new IdComparator());
$elements = $obj->executeStrategy($collection);

$firstElement = array_shift($elements);
$this->assertSame($expected, $firstElement);



$obj = new Context(new DateComparator());
$elements = $obj->executeStrategy($collection);

$firstElement = array_shift($elements);
$this->assertSame($expected, $firstElement);
