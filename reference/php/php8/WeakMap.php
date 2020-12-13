<?php

echo "<pre><h1>WeakMap</h1>";


echo "<p>Link some data to object. If object is destroied, associated data to object are removed too</p>";

class Image {
    public function __destruct() {
        echo "destruct Image\n";
    }
}

class Product {
    private WeakMap $imageCache;
 
    public function __construct() {
        $this->imageCache = new WeakMap();
    }

    public function doSomethingWithImage($img) {
        return $this->imageCache[$img] ??= $this->computeSomethingExpensive($img);
    }
 
    public function computeSomethingExpensive($img) {
        return "expensive_calculated_data_from_image";
    }

    public function imageCacheSize() {
        return count($this->imageCache); // count of items in cache
    }
}

$product = new Product();
$image = new Image();

echo $product->doSomethingWithImage($image)."\n";
echo $product->imageCacheSize()."\n";
unset($image); // destruction of image remove data from imageCache
echo $product->imageCacheSize()."\n";
