<?php

// iterable object without standard php interface

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


class ItemsList
{
    private array $items = [];
    private int $currentIndex = 0;

    public function valid($key):bool
    {
        return isset($this->items[$key]);
    }
    
    public function get($key):Item
    {
        return $this->items[$key];
    }
    
    public function add(Item $item):void
    {
        $this->items[] = $item;
    }

    public function remove(Item $itemToRemove):void
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
}

class ItemsListIterator
{
    private ItemsList $list;
    protected int $currentIndex = 0;

    public function __construct(ItemsList $list)
    {
        $this->list = $list;
    }

    public function count(): int
    {
        return $this->list->count();
    }

    public function current(): Item
    {
        return $this->list->get($this->currentIndex);
    }

    public function key(): int
    {
        return $this->currentIndex;
    }

    public function next():void
    {
        $this->currentIndex++;
    }

    public function rewind()
    {
        $this->currentIndex = 0;
    }

    public function valid(): bool
    {
        return $this->list->valid($this->currentIndex);
    }
}

$list = new ItemsList();
$list->add(new Item('title1'));
$list->add(new Item('title2'));
$list->add(new Item('title3'));
var_dump($list);
$iterator = new ItemsListIterator($list);

$iterator->rewind();
while ($iterator->valid()) {
    $item = $iterator->current();
    echo $item->getTitle().PHP_EOL;
    $iterator->next();
}