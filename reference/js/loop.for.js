var a = [1,2,3];
for (var i = 0; i < a.length; i++) {
	console.log(a[i]);
}

var a = [1,2,3];
for (x in a) {
  console.log(a[x]);
}

var a = {a:1, b:2, c:3};
for (x in a) {
  console.log(a[x]);
}

var a = [1,2,3];
for (x of a) {
  console.log(x);
}