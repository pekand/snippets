
var o1 = {
	p1:1,
	p2:2,
}

var o2 = {
	p2:5,
	p3:3,
	p4:4,
}

// merge object
var o3 = { ...o1, ...o2}; // return {p1: 1, p2: 5, p3: 3, p4: 4}

var a1 = [1,2,3,4];
var a2 = [4,5,6];

var a3 = [...a1, ...a2, 7]; //[1, 2, 3, 4, 4, 5, 6, 7]