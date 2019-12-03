var v = 1;

if (true) {
	// code
} else {
	// code
}

for (var i = 0; i< 10 ; i++){
	break;
    continue;
}

var a = {a:1, b:2, c:3};
for (var x in a) {
	console.log(a[x]);
}

var a = [1, 2, 3];
for (var x of a) {
  console.log(x);
}

do {
	// code
}while (true);

while (true) {
	// code
}

var exp = 0;
switch(exp) {
  case 0:
  case 1:
  	// code
    break;
  case 2:
    // code
    break;
  default:
	// code
}


try {
  throw 'exception'; 
} catch (e) {
  console.log(e);
} finally {
  console.log('finally');
}


function fun (a, b) {
	return a + b;
}

var  o = {a:1};
delete o.a; // o.a is undefined

void(0);

typeof 1  == "number"
typeof ""  == "string"
typeof true == "boolean"
typeof x == "undefined"


var date  = new Date();
date instanceof Date == true;
 
const PI = 3.14;

class Rectangle {
  constructor(height, width) {
    this.name = 'Rectangle';
    this.height = height;
    this.width = width;
  }
  sayName() {

  }
  get area() {
    return this.height * this.width;
  }
  set area(value) {
    this._area = value;
  }
}

class Square extends Rectangle {
  constructor(length) {
    this.height;
    super(length, length);
    this.name = 'Square';
  }
}

var square = new Square(100);

with (Math) {
  x = r * cos(PI);
  y = r * sin(PI / 2);
}

function * foo(x) {
    while (true) {
        x = x * 2;
        yield x;
    }
}
var g = foo(2);
g.next(); // -> 4
g.next(); // -> 8



function resolveAfter2Seconds(x) { 
  return new Promise(resolve => {
    setTimeout(() => {
      resolve(x);
    }, 2000);
  });
}

async function f1() {
  var x = await resolveAfter2Seconds(10);
  console.log(x); // 10
}

f1();