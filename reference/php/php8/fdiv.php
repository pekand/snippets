<?php

echo "<pre><h1>fdiv</h1>";

var_dump(fdiv(10.0, 2.0));
var_dump(fdiv(10, 0));
var_dump(fdiv(10, 0)==INF);
var_dump(fdiv(-10, 0));
var_dump(fdiv(-10, 0)==-INF);
