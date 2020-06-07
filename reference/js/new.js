
function Obj1() {
    this.a = 1;
}

function Obj2() {
    this.b = 2;
}

Object.prototype.c = 3;

var o1 = new Obj1();
Obj1.prototype.d = 4;

var o2 = new Obj2();
console.log(o1, o2);  // -> Obj1 { a: 1 } Obj2 { b: 2 } 

console.log(o1.c, o2.c); // -> 3 3
console.log(o1.d, o2.d); // -> 4 undefined
