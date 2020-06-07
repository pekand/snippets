/*
    create class using function
*/
function Obj (params) {
    this.attrib1 = 'value';
    this.method1 = function() {
        return 'value';
    };
}
 
obj = new Obj();
console.log(obj.method1());

/*
    create method with prototype
*/
function Obj (params) {
    this.attrib1 = 'value';
}

Obj.prototype.method1 = function() {
    return 'value';
};

obj = new Obj();
console.log(obj.method1());

/*
    create object with object literals
*/
var obj = {
    attrib1: "value",
    method1: function () {
        return 'value';
    }
}
console.log(obj.method1());
