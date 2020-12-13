<?php

echo "<pre><h1>non-capturing catches</h1>";

try {
    throw new Exception("Error Processing Request", 1);
} catch (Exception) { // no variable is needed
     echo "error";
}
