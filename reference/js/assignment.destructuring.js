
/*
    destructuring array
*/

var a, b;
[a, b] = [1, 2];
console.log(a, b); // -> 1 2


/*
    destructuring array from variable
*/

var a, b;
var ar = [1 ,2];
[a, b] = ar;
console.log(a, b); // -> 1 2


/*
    destructuring array with default value
*/

var a, b;
[a=1, b=2] = [1];
console.log(a, b; // -> 1 2

/*
    destructuring fist two elemnts of array and get rest of array to separate variable
*/

var a, b, rest;
[a, b, ...rest] = [1, 2, 3, 4, 5]; // spred operator must by last element
console.log(a, b, rest); // -> 1 2  [3, 4, 5]

/*
    swap variable values
*/

var a = 1;
var b = 3;
[a, b] = [b, a];
console.log(a); // -> 3
console.log(b); // -> 1

/*
    swap array values
*/

var a = [1, 2, 3];
[a[0], a[2]] = [a[2], a[0]]; // -> switch first and last element
console.log(a); // -> [3, 2, 1]


/*
    destructuring retturn value from function
*/

function f1() {
    return [1, 2];
}
var a, b;
[a, b] = f1(); // -> switch first and last element
console.log(a, b); // -> 1 2


/*
    skip value
*/

var a, b;
[a, ,b] = [1, 2, 3];
console.log(a, b); // -> 1 3

/*
    object destructuring
*/

const o = {
    a: 1,
    b: 2
};

var {a, b} = o;
console.log(a, b)


/*
    object destructuring without declaration of assigned object
*/

const {a, b} = {a: 1, b: 2}; // varian1
({a, b} = {a: 1, b: 2});  // variant2 parentheses () are required 


/*
    object destructuring and rename variables
*/

const o = {a: 1, b: 2};
const {a: x, b: y} = o;
console.log(x,y); // -> 1 2


/*
    rename invalid idenfifier
*/

const o = {'custom-name': 1};
const {'custom-name': customName} = o;
console.log(customName); // -> 1

/*
    object destructuring default value
*/

const o = {a: 1};
const {a =1, b = 2} = o;
console.log(a,b); // -> 1 2

/*
    object destructuring default value and rename
*/

const o = {a: 1};
const {a:x = 1, b:y = 2} = o;
console.log(x,y); // -> 1 2

/*
    destructure array parameter in function
*/

function f([a,b]){
    console.log(a,b); // -> 1 2
}
f([1,2]);

/*
    destructure object parameter in function
*/

function f({a,b}){
    console.log(a,b); // -> 1 2
}
f({a:1,b:2});

/*
    destructure inner object parameter in function
*/

function f({a, b: {c} }){
    console.log(a,c); // -> 1 3
}

f({
    a:1,
    b:{
        c:3
    }
});


/*
    destructure object parameter in function default value
*/
function f({a=1, b = 2} = {}){
    console.log(a,b); // -> 1 2
}
f();

/*
    destructure object parameter in function default value with inner object
*/
function f({a=1, b: {c=3} } = {b:{}}){
    console.log(a,c); // -> 1 3
}
f();


/*
    destructure object in for cycle
*/

const items = [
  {
    name: 'a',
    value: 1
  },
  {
    name: 'b',
    value: 2
  },
];

for (const {name: n, value: v} of items) {
  console.log(n,v);
}

/*
    use string variable with attribute name as select for what destructure
*/

let o = {a: 1};
let key = 'a';
let {[key]: value} = o;
console.log(value); // -> 1


/*
    destructure object wit rest
*/

let {a, b, ...rest} = {a: 1, b: 2, c: 3, d: 4}
console.log(a, b, rest); // -> 1 2 { c: 3, d: 4 }
