<?php

// define object witch interpret opperations with specific object
// operations are as primitive language 'item title 2' command for get title of item 2 in item list

class Item
{    
    private $title;
    private $content;

    function __construct($title, $content)
    {
        $this->content = $content;
        $this->title = $title;
    }

	function getTitle()
    {
        return $this->title;
    }
    
    function getContent()
    {
        return $this->content;
    }
}

class ItemList
{
    private $items = array();
    private $itemCount = 0;

    public function __construct()
    {
    }

    public function getItemCount()
    {
        return $this->itemCount;
    }

    private function setItemCount($newCount)
    {
        $this->itemCount = $newCount;
    }

    public function getItem($itemNumberToGet)
    {
        if ((is_numeric($itemNumberToGet)) && ($itemNumberToGet <= $this->getItemCount())) {
            return $this->items[$itemNumberToGet];
        } else {
            return NULL;
        }
    }

    public function addItem(Item $item)
    {
        $this->setItemCount($this->getItemCount() + 1);
        $this->items[$this->getItemCount()] = $item;
        return $this->getItemCount();
    }

    public function removeItem(Item $item)
    {
        $counter = 0;
        while (++$counter <= $this->getItemCount()) {
            if ($item->getTitle() == $this->items[$counter]->getTitle()) {
                for ($x = $counter; $x < $this->getItemCount(); $x++) {
                    $this->items[$x] = $this->items[$x + 1];
                }
                $this->setItemCount($this->getItemCount() - 1);
            }
        }
        return $this->getItemCount();
    }
}

class Interpreter
{
    private $itemList;

    public function __construct($itemListIn)
    {
        $this->itemList = $itemListIn;
    }

    public function interpret($stringIn) // primitive interpreter
    {
        $arrayIn = explode(" ", $stringIn);
        $returnString = NULL;

        if ('item' == $arrayIn[0]) {
            if ('content' == $arrayIn[1]) {
                if (is_numeric($arrayIn[2])) {
                    $item = $this->itemList->getItem($arrayIn[2]);
                    if (NULL == $item) {
                        $returnString = 'Can not process, there is no item # ' . $arrayIn[2];
                    } else {
                        $returnString = $item->getTitle();
                    }
                } elseif ('title' == $arrayIn[2]) {
                    if (is_numeric($arrayIn[3])) {
                        $item = $this->itemList->getItem($arrayIn[3]);
                        if (NULL == $item) {
                            $returnString = 'Can not process, there is no item # ' .
                                $arrayIn[3];
                        } else {
                            $returnString = $item->getTitle();
                        }
                    } else {
                        $returnString = 'Can not process, item # must be numeric.';
                    }
                } else {
                    $returnString = 'Can not process, item # must be numeric.';
                }
            }
            if ('title' == $arrayIn[1]) {
                if (is_numeric($arrayIn[2])) {
                    $item = $this->itemList->getItem($arrayIn[2]);
                    if (NULL == $item) {
                        $returnString = 'Can not process, there is no item # ' .
                            $arrayIn[2];
                    } else {
                        $returnString = $item->getTitle();
                    }
                } else {
                    $returnString = 'Can not process, item # must be numeric.';
                }
            }
        } else {
            $returnString = 'Can not process, can only process item content #,  item title #, or item content title #';
        }
        return $returnString;
    }
}


//load ItemList for test data
$itemList = new ItemList();
$inItem1 = new Item('Title1', 'Text1');
$inItem2 = new Item('Title2', 'Text2');
$itemList->addItem($inItem1);
$itemList->addItem($inItem2);

$interpreter = new Interpreter($itemList);
echo $interpreter->interpret('content 1') . PHP_EOL; // commands executet wit object
echo $interpreter->interpret('item content 1') . PHP_EOL;
echo $interpreter->interpret('item title 2') . PHP_EOL;
echo $interpreter->interpret('item content title 1') . PHP_EOL;
echo $interpreter->interpret('item title 3') . PHP_EOL;
echo $interpreter->interpret('item title one') . PHP_EOL;
