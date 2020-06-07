"use strict"; // must by on beggining of script

function func() {
  "use strict"; // must by on beggining of function
}

a = 'value';  //variable must be declared
delete a; // variable can't be deleted

var x = 010; // octal numbers are not allowed
var x = "\010"; // octal escape characters are not allowed

eval("var x = 1+1"); 
console.log(x); // create variable in eval is not allowed

