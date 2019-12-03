// /modules/module.js 
export class CustomClass {}
export function customFunction() {
 //code
}

export let customVariable;
export { customVariable1, customVariable2, customVariable3 };
export { customVariable1 as name3, customVariable1 as name2, customVariable3 };
export const { name1, name2: bar } = o;


export { myFunction as default };
export default myFunction() { } 
export default class {  }

let k; export default k = 12;
import m from './test'; /* m is imported k */

import * as customModule from '/modules/module.js';
customModule.customFunction();

import {CustomClass, customFunction, customVariable} from '/modules/module.js';
import {customFunction1 as customFunction} from '/modules/module.js';
customFunction()
 
import('/modules/my-module.js').then((module) => {
  // code
});

let module = await import('/modules/module.js');