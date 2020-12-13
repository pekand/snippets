<?php

namespace namespace1\for; // allow keywork in namespace name, for backward compatibility

echo "<pre><h1>Treat namespaced names as single token</h1>";

function fun1() { 
    return 111;
}
 
use namespace1\for; 
 
echo fun1();
