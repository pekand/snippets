var s = "";

s.constructor;
s.length;
s.prototype;

s.charAt(1); // char on position in string
s.charCodeAt(1); // return int utf code representation on position
s.concat("string1", " ", "string4"); // contact n strings with current string
var isEndsOnStringBool =  s.endsWith('?'); // check if string ends on string
s.endsWith('?', 4); // check if string ends on string on positions
s.fromCharCode("32","32","32"); // create string from n utf8 chars represented by int
s.includes("string"); // check if string contains string
s.includes("string", 5); // check if string contains string start from index 5
s.indexOf("string"); // check if string contans string. return position or -1
s.indexOf("string", 5); // check if string contans string. return position or -1, start on position
s.lastIndexOf("string"); // return string position from beckward
s.lastIndexOf("string", 5); // return string position from beckward, check beckward from specified position
s.localeCompare("string"); // compare string in local alphabet a~b=-1 b~a=1 a~a=0 
s.localeCompare("string", "en");
s.localeCompare("string", "sk", {ignorePunctuation: true, caseFirst:true, numeric:true});
s.match(/^*$/g); //return groups or null
s.padEnd(10, '.'); // pad witch character from end string....
s.padStart(4, '0') // pad wrom start with string 0001
s.repeat(10); // repeat and concat string
s.replace("searchfor", "replace with");
s.replace(/searchfor/, "replace with");
s.search(/searchfor/); // return position of dirt match or -1
s.slice(10); // return string start of 10 index of character to end of string
s.slice(-10); // return string start of LENGHT-10 index of character to end of string
s.slice(0, 10); // return from index 0 to index 10 (last index is not included)
s.slice(0, 10); // return from index 0 to index 10 (last index is not included)
s.slice(0, -3); // return from index 0 to index LENGHT-3 
s.slice(-10, -3); // return from index LENGHT-10 to index LENGHT-3 
s.split(" "); // split sting to array " " is separator
s.split(""); // split sting to array of characters
s.split(" ", 2); // return only 2 items from split rest of string is ommited 
s.startsWith("Startwith"); // check if string start with string
s.substr(5, 10); // depracated return substring (start, lenght)
s.substring(5); // return string start of 10 index of character to end of string
s.substring(-10); // is converted to s.substring(0)
s.substring(-10, -1); // is converted to s.substring(0, 0)
s.substring(-10, 10); // is converted to s.substring(0, 10)
s.substring(5, 10); // return substring (start, end index) end index is not included
s.substring(10, 5); // return substring (end index, startindex) swap order of parameters becouse 5<10
s.toLocaleLowerCase();
s.toLocaleLowerCase("en-US");
s.toLocaleUpperCase();
s.toLocaleUpperCase("en-US");
s.toLowerCase();
s.toString();
s.toUpperCase();
s.trim(); // trim spaces
s.trimStart(); // trim spaces from beginning of string
s.trimEnd(); // trim spaces from end of string
s.valueOf(); // return string value from string object (new String("value")).valueOf() === "value"
