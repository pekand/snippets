var a = [];

a.constructor;
a.length;
a.prototype;

a.concat([1, 2, 3]); // concat array after source array into one array

a.copyWithin(0,3,5); // copy part of array to index 0, part of array start on index 3 and finish on index 5 (not incudes). Dont change array size
[1,2,3,4,5,6,7].copyWithin(0,3,5); // return [4, 5, 3, 4, 5, 6, 7]
[1,2,3,4,5,6,7].copyWithin(6,3,5); // return [1, 2, 3, 4, 5, 6, 4]


var iterator = ["a","b", "c"].entries(); // return iterator
console.log(iterator.next().value); // return [0, "a"]

[1,2,3].every(x => x < 10); // check if evry element pass test in callbeck

var o = {o:1};
[1, 2, 3, 4].every((e, i ,a)=>{console.log(e,i,a, this.o); return e>3}, o); // pass object o as this to callback

[1, 2, 3, 4].fill(0,1,3); // return [1, 0, 0, 4]; fill with 0 elements from index 1 to index 3 (not included) dont change array size
[1, 0, 0, 0].fill(0,1,10) // return [1, 0, 0, 0]

[1, 2, 3, 4].filter((e, i ,a)=>e>3); // return [4]; new array from elements witch pass test (e - element i - index a - array)

var o = {o:1}; 
[1, 2, 3, 4].filter((e, i ,a)=>{console.log(e,i,a, this.o); return e>3}, o); // pass variable o as this for callback

[1, 2, 3, 4].find(e => e > 1); // return 2; value of first element witch satisfies test

var o = {o:1}; 
[1, 2, 3, 4].find((e, i ,a)=>{console.log(e,i,a, this.o); return e>1}, o); // pass object as this for callbeck

[1, 2, 3, 4].findIndex(e => e > 1); // return 1; find index of element witch satisfies test

var o = {o:1}; 
[1, 2, 3, 4].findIndex((e, i ,a)=>{console.log(e,i,a, this.o); return e>1}, o); // pass object as this for callbeck

[1, 2, [3, 4, 5]].flat(); // return [1, 2, 3, 4, 5]; move elements from subarray to up about 1 level
[1, 2, [3, [4, 5]]].flat(); // return [1, 2, 3, [4, 5]]; 
[1, 2, [3, [4, 5]]].flat(2); // return [1, 2, 3, 4, 5];  // specify recursive depth


[1, 2, 3, 4].flatMap(x => [x * 2]); // return [2, 4, 6, 8]; first calculate element then make flat on array depth 1

var o = {o:1}; 
[1, 2, 3, 4].flatMap((e, i ,a)=>{console.log(e,i,a, this.o); return [e]; }, o);  // add this to callback function as parameter
 

[1, 2, 3, 4].forEach(e => console.log(e)); // return undefined; execute callback for each element 

var o = {o:1}; 
[1, 2, 3, 4].forEach((e, i ,a)=>{console.log(e,i,a, this.o);}, o);  // add this to callback function as parameter

Array.from('aaaa'); // convert somthink like array to array ["a", "a", "a", "a"]
Array.from([1, 2, 3], x => x + x); // map function called for evry element in array [2, 4, 6]

[1, 2, 3, 4].includes(3); // return true; check if contain value
[1, 2, 3, 4].includes(3, 2); // start from index 2

[1, 2, 3, 4].indexOf(3); // retun 2
[1, 2, 3, 4].indexOf(3, 2); // return 2; search from index position (included)


Array.isArray([1, 2, 3]); // check if is it array

[1, 2, 3].join(); // return "1,2,3"; join string use "," as separator
[1, 2, 3].join(""); // return "123"; custom separator
[1, 2, 3].join(""); // return "1 2 3"; 

var iterator = ["a","b","c"].keys(); // return iterator with key names
for (var key of iterator) {
  console.log(key);
}

[1,2,1,2, 3, 4].lastIndexOf(2); // return 3; last index of element

[1,2,3,4].map(x => x * x); // return [1, 4, 9, 16] appli function to evry element

var o = {o:1}; 
[1, 2, 3, 4].map((e, i ,a)=>{console.log(e,i,a, this.o);}, o);  

var o = {p:1}; 
[1, 2, 3, 4].map(function(e, i ,a){console.log(e,i,a, this);}, o); // add this to callback function as parameter


Array.of(1, 2, 3) // convert b parameters to array; return [1, 2, 3]

var p = [1,2,3,4]; 
console.log(p.pop()); // return 4; return and remove last elemnet
console.log(p);

var p = [1,2,3,4]; 
console.log(p.push(6)); // return 5; add element and return new array length
console.log(p);

[1,2,3].reduce((a,x)=>a+x,0); // return 6; acumulate value to single value with callbeck function; in example count all values to one; set init value for acumulator

[1, 2, 3, 4].reduce((ac, e, i ,a)=>{ console.log(ac,e,i,a); return ac+e;}, 0); 

[1,2,3].reduceRight((a,x)=>a.concat(x),""); // return "321"; inverse reduce from back to start

[1, 2, 3, 4].reduceRight((ac, e, i ,a)=>{ console.log(ac,e,i,a); return a.concat(x);},""); 

[1, 2, 3, 4].reverse(); // return [4, 3, 2, 1]; reverse array

var p = [1,2,3,4]; 
console.log(p.shift()); // return 1;  remove and return first item from array
console.log(p); // return [2, 3, 4]

[1,2,3,4].slice(2); // return [3, 4]
[1,2,3,4].slice(-2); // return [3, 4] LENGTH-2
[1,2,3,4].slice(2, 4); // return [3, 4]
[1,2,3,4].slice(-4, -2); // [1, 2] LENGTH-4 ... LENGTH-2
[1,2,3,4].slice(1, -1); // [2, 3]  1 .. LENGTH-1

[1,2,3,4].some(x => x>3); // check if same value pass condition
[1,2,3,4].some(function(e, i, a){console.log(e,i,a, this); return e>3}, {p:1}); // change this 

[4,3,2,1].sort(); // sort elements
[4,3,2,1].sort(function(a, b){
	if (a > b) {
		return 1;
	} 
	
	if (a < b) {
		return -1;
	} 
	
	return 0;
});

var p = [1,2,3,4,5];
p.splice(2, 0, 6, 7); // add elements 6 , 7, (... variable amout of elements) after index 2; change source array 
console.log(p); // return [1, 2, 6, 7, 3, 4, 5]

var p = [1,2,3,4,5];
var d = p.splice(2, 2, 6, 7); // remove 2x elements after 2 index and rerurn deleted ements, add elements 6 , 7, (... variable amout of elements) after index 2; change source array 
console.log(d); // return [3, 4]
console.log(p); // return [1, 2, 6, 7, 5]

var p = [1,2,3,4,5];
var d = p.splice(2, 2); // remove 2x elements after 2 index and rerurn deleted ements
console.log(d); // return [3, 4]
console.log(p); // return [1, 2, 5]

[1,2,3,4,5].toString(); // return string "1,2,3,4,5"

var p = [1,2,3,4,5];
var l = p.unshift(6, 7); // add values (6, 7, ... (variable ammount of elements) ) to beggining of array
console.log(l); // return 7 new length of array
console.log(p); // return [6, 7, 1, 2, 3, 4, 5]

[1, 2, 3].valueOf(); // return [1, 2, 3]; primitive type of object
