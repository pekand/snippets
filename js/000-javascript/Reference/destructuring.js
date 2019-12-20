
//destructuring object to variables

var o = {
	p1:1,
	p2:2,
	p3:3
}

//destructuring
function f1({p1, p2, p3}) { 
	console.log(p1, p2, p3);
}

f1(o); // return 1, 2, 3

//destructuring
function f2(o) { 
	const {p1, p2, p3} = o; // name must by same as property in object
	console.log(p1, p2, p3);
}

f2(o); // return 1, 2, 3
