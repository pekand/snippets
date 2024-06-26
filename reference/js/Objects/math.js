Math.E;
Math.LN2;
Math.LN10;
Math.LOG2E;
Math.LOG10E;
Math.PI;
Math.SQRT1_2;
Math.SQRT2;

Math.abs(x);
Math.acos(x);
Math.acosh(x);
Math.asin(x);
Math.asinh(x);
Math.atan(x);
Math.atan2(y, x);
Math.atanh(x);
Math.cbrt(x);
Math.ceil(x);
Math.cos(x);
Math.cosh(x);
Math.exp(x);
Math.floor(x);
Math.log(x);
Math.max(x, y, z, ..., n);
Math.min(x, y, z, ..., n);
Math.pow(x, y);
Math.random(); /* 0<= x < 1 */
Math.round(x);
Math.sin(x);
Math.sinh(x);
Math.sqrt(x);
Math.tan(x);
Math.tanh(x);
Math.trunc(x);

function getRandomArbitrary(min, max) { // min <= x < max
  return Math.random() * (max - min) + min;
}