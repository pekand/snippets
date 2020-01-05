<?php
echo "<pre>";

eval("echo \"evaluated string\n\";");
$value = eval("return \"value from eval function\n\";");
echo $value;

$template = eval("?>template<?php");
echo $template."\n";

try {
    eval("/");
}
catch(ParseError $e){ // todo
    echo $e->getMessage();      
}