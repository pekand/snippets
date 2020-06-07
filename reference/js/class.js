/*
    Class with constructor
*/
class Obj {
  constructor(param) {
    this.attrib = param;
  }

  method() {
    return this.attrib;
  }
}

// note: class is not hoisted > definition must be before declaration
// note: class use strict mode by default
obj = new Obj("value"); 
console.log(obj.method()); // -> value

/*
    Class with static method
*/
class Obj {
  constructor(param) {
    this.attrib = param;
  }

  static staticMethod() {
    return 'value';
  }

  static staticMethod2() {
    return this.staticMethod();
  }
}

obj = new Obj("value");
console.log(Obj.staticMethod()); // -> value
console.log(Obj.staticMethod2()); // -> value

/*
    Class inheritance
*/
class ObjParent {
  constructor(param) {
    this.attrib = param;
  }
}

class ObjChild extends ObjParent {
  constructor(param) {
    super(param);
  }

  method() {
    return this.attrib;
  }
}

obj = new ObjChild("value");
console.log(obj.method());

/*
    Getters and Setters
*/
class Obj {
  get attrib() {
    return this._attrib;
  }
  set attrib(value) {
    this._attrib = value;
  }
}

obj = new Obj();
obj.attrib = 'value'
console.log(obj.attrib); // -> value
