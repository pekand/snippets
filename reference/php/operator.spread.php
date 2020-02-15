<?php

// php7.4

$a1 = [1,2,3];
$a2 = [1,2,3, ...$a1, 4];

var_dump($a2);

/*
array(7) { 
  [0]=>    
  int(1)   
  [1]=>    
  int(2)   
  [2]=>    
  int(3)   
  [3]=>    
  int(1)   
  [4]=>    
  int(2)   
  [5]=>    
  int(3)   
  [6]=>    
  int(4)   
}          
*/

function gen() {
    for($i = 0; $i < 5; $i++) {
        yield $i;
    }
}

// can by used with iterrable objects
$a3 = [...gen()];

/*

array(7) {  
  [0]=>     
  int(1)    
  [1]=>     
  int(2)    
  [2]=>     
  int(3)    
  [3]=>     
  int(1)    
  [4]=>     
  int(2)    
  [5]=>     
  int(3)    
  [6]=>     
  int(4)    
}           

*/