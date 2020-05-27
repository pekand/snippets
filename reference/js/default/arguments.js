function func(a, b, c) {
    console.log(arguments[0]); 
    console.log(arguments[1]);
    console.log(arguments[2]);

    var args = Array.prototype.slice.call(arguments); // convert to array
    var args = [].slice.call(arguments);  // convert to array
    let args = Array.from(arguments); // convert to array
}
func(1, 2, 3);