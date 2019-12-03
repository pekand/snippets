// left-to-right
v = ((((a+b)+c)+d)+e);

/* right-to-left */
v1 = (v2 = (v3 = (v4)));

v = (a+(b/c)); 

/* priority in logical operators '||' < '&&' < '==' (left-to-right)*/
(b1 && b2 || b3 && b4) == ((b1 && b2) || (b3 && b4))
(b1 || b2 && b3 || b4) == (b1 || (b2 && b3) || b4) == ((b1 || (b2 && b3)) || b4)

/* PRIORITIES */

/* 21 */
(1+2); //grouping

/* 20 left-to-right */  
o.a; // Member Access
a[0] // Computed Member Access
new  Date(); //new with argument list
func(); // Function Call
o?.a; // optional chaining (check if a exists in object if not return null or undefined)

/* 19 */
new Date;  // new without argument list

/*18*/
i++; // Postfix Increment
i--; // Postfix Decrement

/* 17 right-to-left*/
!b; // Logical NOT
~i; // Bitwise NOT
+3; // Unary Plus
-3; // Unary Negation
++i; // Prefix Increment
--i; // Prefix Decrement
typeof o; // typeof 
void(0); 
delete o.a;
await fun();

/* 16 right-to-left */
2 ** 10; // Exponentiation

/* 15 left-to-right */
a*b;
a/b; 
a%b; // Remainder 

/* 14 left-to-right */
a+b;
a-b; 

/* 13 left-to-right*/
i<<2; // Bitwise Left Shift
i>>2; // Bitwise Right Shift
i>>>2; // Bitwise Unsigned Right Shift

/* 12 left-to-right*/
a<b;
a<=b;
a>b; 
a>=b; 
a in o; 0 in a; // check if attribute a exists in object or index exists in array
d instanceof Date;

/* 11 left-to-right*/
a == b
a != b
a === b
a !== b

/* 10 left-to-right*/
a & b; // Bitwise AND

/* 9 left-to-right*/
^ // Bitwise XOR

/* 8 left-to-right*/
| // Bitwise OR

/* 7 left-to-right*/
a ?? b; // Nullish coalescing operator if (a == null || typeof a == "undefined") retun b else return a;

/* 6 left-to-right*/
a && b; // Logical AND

/* 5 left-to-right*/
|| // ogical OR

/* 4 right-to-left*/
b?v1:v2; // Conditional

/* 3 right-to-left */ 
v = 1; // Assignment
v += 1;
v -= 1;
v **= 1;
v *= 1;
v /= 1;
v %= 1;
v <<= 1;
v >>= 1;
v >>>= 1;
v &= 1;
v ^= 1;
v |= 1;

/* 2 right-to-left */
yield // pause and resume a generator function
yield* //  delegate to another generator

/* 1 left-to-right */
x = 2, 3 == 3; // Comma, Sequence
