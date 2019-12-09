
typeof undefined === 'undefined';
var declaredUnset;
typeof declaredUnset === 'undefined';
typeof undeclared === 'undefined'; 

typeof 3 === 'number';
typeof 3.14 === 'number';
typeof Infinity === 'number';
typeof NaN === 'number';

typeof '' === 'string';
typeof 'bla' === 'string';
typeof `template literal` === 'string';
typeof '1' === 'string';
typeof String(1) === 'string';

typeof true === 'boolean';
typeof false === 'boolean';

typeof Symbol() === 'symbol'

typeof {a: 1} === 'object';

typeof [1, 2, 4] === 'object';

typeof new Date() === 'object';
typeof /regex/ === 'object';

typeof new Boolean(true) === 'object'; 
typeof new Number(1) === 'object'; 
typeof new String('abc') === 'object';

typeof function() {} === 'function';
typeof class C {} === 'function';
typeof Math.sin === 'function';