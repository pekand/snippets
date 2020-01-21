<?php

// iterable object with standard php interface

class Item
{
     private string $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }
    
    public function getTitle(): string
    {
        return $this->title;
    }
}

/*

Countable {
    abstract public count ( void ) : int
}

Iterator extends Traversable {
    abstract public current ( void ) : mixed
    abstract public key ( void ) : scalar
    abstract public next ( void ) : void
    abstract public rewind ( void ) : void
    abstract public valid ( void ) : bool
}

*/
class ItemsList implements Countable, Iterator
{
    private array $items = [];
    private int $currentIndex = 0;

    public function add(Item $item)
    {
        $this->items[] = $item;
    }

    public function remove(Item $itemToRemove)
    {
        foreach ($this->items as $key => $item) {
            if ($item->getTitle() === $itemToRemove->getTitle()) {
                unset($this->items[$key]);
            }
        }

        $this->items = array_values($this->items);
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function current(): Item
    {
        return $this->items[$this->currentIndex];
    }

    public function key(): int
    {
        return $this->currentIndex;
    }

    public function next()
    {
        $this->currentIndex++;
    }

    public function rewind()
    {
        $this->currentIndex = 0;
    }

    public function valid(): bool
    {
        return isset($this->items[$this->currentIndex]);
    }
}

$list = new ItemsList();
$list->add(new Item('title1'));
$list->add(new Item('title2'));
$list->add(new Item('title3'));

$items = [];

foreach ($list as $item) {
    $items[] = $item->getTitle();
}

print_r($items);

$item = new Item('title1');
$item2 = new Item('title2');

$list = new ItemsList();
$list->add($item);
$list->add($item2);
$list->remove($item);

$items = [];
foreach ($list as $item) {
    $items[] = $item->getTitle();
}
       
print_r($items);        

$item = new Item('title1');
$list = new ItemsList();
$list->add($item);

echo count($list).PHP_EOL;

$list->remove($item);

echo count($list).PHP_EOL;

