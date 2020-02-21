<?php

/*
    Pattern allow change alghoritm in object. (No 'switch' for using multiple alghoritms. New alghoritm can by add without changing code)

    ItemsSortingContext store strategy for sorting element in ItemsList
    Context object can have diferent strategy for sorting elements
    ItemsList don't depend on sorting algorithms. They are changeable be a context strategy object.

    (context ItemsList and ItemsSortingContext can be same object)
*/

class ItemsList {

    private $items = [];

    public function __construct(){

    }

    public function addItem($item){
        $this->items[] = $item;
    }

    public function count(){
        return count($this->items);
    }

    public function getItems(){
        return $this->items;
    }

    public function sort($comparator){
        usort($this->items, $comparator);
    }

}

interface ComparatorStrategy
{
    public function compare($a, $b): int;
}

class ItemsSortingContext // Context class allow separate code from main class is not mandatoy, but if class has many strategy contexts is better separate context to new class
{
    private ComparatorStrategy $comparator;

    public function __construct(ComparatorStrategy $comparator)
    {
        $this->comparator = $comparator;
    }

    public function setStrategy(ComparatorStrategy $comparator)
    {
        $this->comparator = $comparator;
    }

    public function sort(ItemsList $items) // items can be provided by constuctor or  ItemsList and ItemsSortingContext can be some object
    {
        $items->sort([$this->comparator, 'compare']);

    }
}

class LengthComparatorStrategy implements ComparatorStrategy
{
    public function compare($a, $b): int
    {
        return strlen($a) <=> strlen($b);
    }
}


class AlphaComparatorStrategy implements ComparatorStrategy
{
    public function compare($a, $b): int
    {
        return strcmp($a, $b);
    }
}

class NumericComparatorStrategy implements ComparatorStrategy
{
    public function compare($a, $b): int
    {
        return intval($a) <=> intval($b);
    }
}


interface PrintStrategy
{
    public function print($items);
}

class ItemsPrintContext 
{
    private PrintStrategy $printer;

    public function __construct(PrintStrategy $printer)
    {
        $this->printer = $printer;
    }

    public function setStrategy(PrintStrategy $printer)
    {
        $this->printer = $printer;
    }

    public function print(ItemsList $items) // items can be provided by constuctor or  ItemsList and ItemsSortingContext can be some object
    {
        $values = $items->getItems();
        $this->printer->print($values);
    }
}

class TablePrintStrategy implements PrintStrategy
{
    public function print($items)
    {
        for($i = 0; $i < count($items); $i++) {
            echo "|".$items[$i]."|\n";
        }
        
    }
}

class LinePrintStrategy implements PrintStrategy
{
    public function print($items)
    {
        echo "(";
        for($i = 0; $i < count($items); $i++) {
            echo $items[$i].(($i<count($items)-1)?",":"");
        }
        echo ")\n";
    }
}

$items = new ItemsList();

$items->addItem("44");
$items->addItem("5");
$items->addItem("c");
$items->addItem("11111");
$items->addItem("b");
$items->addItem("2222");
$items->addItem("333");
$items->addItem("a");

$printingcontext = new ItemsPrintContext(new TablePrintStrategy());
$printingcontext->print($items);
$printingcontext->setStrategy(new LinePrintStrategy()); // change strategy to print in line

echo "---\n";
$sortingContext = new ItemsSortingContext(new NumericComparatorStrategy());
$sortingContext->sort($items);
$printingcontext->print($items);
echo "---\n";
$sortingContext->setStrategy(new AlphaComparatorStrategy());
$sortingContext->sort($items);
$printingcontext->print($items);
echo "---\n";

$sortingContext->setStrategy(new LengthComparatorStrategy());
$sortingContext->sort($items);
$printingcontext->print($items);
echo "---\n";
