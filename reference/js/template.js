// Template literals

// Template literals

`text`

`\`` 

`multi
 lines`
 
 `${1 + 2}`
 
 var x = 1;
 `${x + x}`
 
`${"a".toUpperCase()}`

`${true?"a":"b"}`
 
`c:\\test\\` // return "c:\test\"
String.raw`c:\\test\\`; // return "c:\\test\\" skip escape cahracters



// tag functions 
function tagFunc(strings, ...expressions) {
  console.log(strings); // ["string1 ", " string2 ", " string3`", raw: ["string1 ", " string2 ", " string3\`", raw: Array(3)]]
  
  expressions.forEach(function(val, i) {
	  console.log(val);
  });

  return `newstring`; // or samthink else like number, object, array, function, ...
}

var expression1 = 1;
var expression2 = 2;
var output = tagFunc`string1 ${ expression1 + 10 } string2 ${ expression2 } string3\`abc`;
console.log(output);
