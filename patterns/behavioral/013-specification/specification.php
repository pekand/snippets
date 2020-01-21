<?php

// validate object against specification (validator) object
// check if Itemp pass Specification for Item object value
// objects contains isSatisfiedBy methods witch check criteria for item

class Item {
    private  $price;

    public function __construct(float $price) {
        $this->price = $price;
    }

    public function getPrice(): float {
        return $this->price;
    }
}

interface Specification {
    public function isSatisfiedBy(Item $item): bool;
}

class PriceSpecification implements Specification
{
    private $maxPrice;
    private $minPrice;

    public function __construct(?float $minPrice, ?float $maxPrice)
    {
        $this->minPrice = $minPrice;
        $this->maxPrice = $maxPrice;
    }

    public function isSatisfiedBy(Item $item): bool
    {
        if ($this->maxPrice !== null && $item->getPrice() > $this->maxPrice) {
            return false;
        }

        if ($this->minPrice !== null && $item->getPrice() < $this->minPrice) {
            return false;
        }

        return true;
    }
}
class OrSpecification implements Specification
{

    private $specifications;


    public function __construct(Specification ...$specifications)
    {
        $this->specifications = $specifications;
    }

    public function isSatisfiedBy(Item $item): bool
    {
        foreach ($this->specifications as $specification) {
            if ($specification->isSatisfiedBy($item)) {
                return true;
            }
        }

        return false;
    }
}


class AndSpecification implements Specification
{

    private $specifications;


    public function __construct(Specification ...$specifications)
    {
        $this->specifications = $specifications;
    }

    public function isSatisfiedBy(Item $item): bool
    {
        foreach ($this->specifications as $specification) {
            if (!$specification->isSatisfiedBy($item)) {
                return false;
            }
        }

        return true;
    }
}

class NotSpecification implements Specification
{
    private $specification;

    public function __construct(Specification $specification)
    {
        $this->specification = $specification;
    }

    public function isSatisfiedBy(Item $item): bool
    {
        return !$this->specification->isSatisfiedBy($item);
    }
}

$spec1 = new PriceSpecification(50, 99);
$spec2 = new PriceSpecification(101, 200);

$orSpec = new OrSpecification($spec1, $spec2);
$andSpec = new AndSpecification($spec1, $spec2);     
$notSpec = new NotSpecification($spec1);

$item1 = new Item(60);
$item2 = new Item(70);

echo $spec1->isSatisfiedBy($item1) ? 1 : 0;
echo $spec2->isSatisfiedBy($item2) ? 1 : 0;
echo $orSpec->isSatisfiedBy($item1, $item2) ? 1 : 0;
echo $andSpec->isSatisfiedBy($item1, $item2) ? 1 : 0;
echo $notSpec->isSatisfiedBy($item1, $item2) ? 1 : 0;
