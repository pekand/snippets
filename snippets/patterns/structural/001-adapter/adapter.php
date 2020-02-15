<?php

// solve incompatible interface


class OldProductClass { // old incompatible class
    private $title;
    function __construct($title) {
        $this->title  = $title;
    }

    function getTitle() {
        return $this->title;
    }
}

interface NewProductClass {
    public function getNewTitle();    
}

class ProductAdapter implements NewProductClass { // wrap product
    private $product;
    
    function __construct(OldProductClass $product) {
        $this->product = $product;
    }
    
    function getNewTitle() {
        return "(".$this->product->getTitle().')'; // modify data to the right form
    }
}

$product = new OldProductClass("product");
$productAdapter = new ProductAdapter($product);
echo  $productAdapter->getNewTitle();
