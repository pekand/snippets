<?php

echo "<pre><h1>Match expression</h1>";

// similar to switch
$rsult = match (8.0) { 
  '8.0' => "Oh no!", // single line expresion (no brake)
   8.0 => "This is what I expected", // strict comparison
}; // is expression

echo $rsult;
