/*
    basic usage
*/

const f = () => 'value'
console.log( f() ); // -> value

/*
    this in arrow function
*/

const f1 = () => console.log(this)
f1(); // -> {}

/*
    this in arrow function compare to normal function in object method
*/

const o1 = {
  m1: () => {
    console.log(this);
  }
};

o1.m1(); // -> {}


const o2 = {
  m2: function() {
    console.log(this);
  }
};

o2.m2(); // -> o2

/*
    this in arrow callback
*/

function fun(callback){
    callback();
}

const o3 = {
  m3: function() {
    fun(() => { console.log(this); })  // this is inheried from parent scope
  }
};

o3.m3(); // -> o3

/*
    thisn in normal function callback
*/

function fun(callback){
    callback();
}

const o4 = {
  m4: function() {
    fun(function(){ console.log(this); })  // this is inheried from parent scope
  }
};

o4.m4(); // -> window


/*
    arrow function with one parameter and one command
*/

var a1 = a => a;
a1(1);

/*
    arrow function with multiple parameters and one command
*/

var a2 = (a,b,c) => a+b+c;
a2(1,2,3);

/*
    arrow function with multiple parameters and multiple commands
*/

var a4 = (a,b,c) => {var x =a+b+c; returnx};
a4(1,2,3);

