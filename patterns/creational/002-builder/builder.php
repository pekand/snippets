<?php
/*
	Use director for product1 construction and allow create other product2 with same director if condtruction process is same as for product1
	product - object whitch must by constructed with operations
	director - who create product
*/

class Product { // Product dont have interface or extend class
    private $body = NULL;
    function __construct() {
    }
    
    function operation1($text) {
      $this->body .= '<operation1>'.$text.'</operation1>'.PHP_EOL;
    }
    
    function operation2($text) {
      $this->body .= '<operation2>'.$text.'</operation2>'.PHP_EOL;
    }
    
    function formatProduct() {
       return '<product>'.PHP_EOL. $this->body.'</product>';
    }
}

abstract class AbstractProductBuilder {
    abstract function operation1($text);
    abstract function operation2($text);
    abstract function getProduct();
}

class ProductBuilder extends AbstractProductBuilder { // encapsulate operations for create product
    private $product = NULL;
    
    function __construct() {
      $this->product = new Product();
    }
    
    function operation1($text) {
      $this->product->operation1($text);
    }
    
    function operation2($text) {
      $this->product->operation2($text);
    }
    
    function getProduct() {
      return $this->product->formatProduct();
    }
}

/*
	Director is independent from product 
	Same process can be used for different products
*/
class Director {
    private $builder = NULL;
    public function __construct(AbstractProductBuilder $builder) { // director use builder instead of product -> product1 can by switched to other product2 with same construction process 
         $this->builder = $builder;
    }
    public function buildProduct() {
      $this->builder->operation1('text1'); // product construction process
      $this->builder->operation2('text2');
    }
    public function getProduct() {
      return $this->builder->getProduct();
    }
}

$productBuilder = new ProductBuilder();
$director = new Director($productBuilder);
$director->buildProduct();
echo $director->getProduct();
