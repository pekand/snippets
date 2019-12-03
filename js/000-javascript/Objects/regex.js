var pattern = /^*$/g;
var s = "";

pattern.constructor;
pattern.global;
pattern.ignoreCase;
pattern.lastIndex;
pattern.multiline;
pattern.source;

pattern.exec() 
pattern.test() 
pattern.toString()





s.match(pattern);
s.replace(pattern, "value");
s.search(pattern);

/* Modifiers */

// g    global match 
// i    case-insensitive matching
// m    multiline matching

/* Brackets */

// [abc]    Find character
// [^abc]   Find NOT character
// [0-9]    any digit
// [^0-9]   non-digit
// [a-zA-Z]
// (regex1|regex2)  alternatives

/* Metacharacters */

// .    character
// \w   word character
// \W   non-word character
// \d   digit
// \D   non-digit character
// \s   whitespace character
// \S   non-whitespace character
// \b   beginning/end of a word
// \B   not at the beginning/end of a word
// \0   NUL character
// \n   new line character
// \f   feed character
// \r   return character
// \t   tab character
// \v   vertical tab character
// \xxx character specified by an octal number
// \xdd character specified by a hexadecimal number dd
// \udddd   Unicode character specified by a hexadecimal number dddd

/* Quantifiers */

// n+  match n, nn, nnn, ...
// n*  match "", n, nn, nnn, ...
// ab?c  optional match "abc" or "ac" 
// a*? Matches as few characters as possible.
// n{2}    match nn
// n{2,4}  match nn or nnn or nnnnn
// n{2,}   match nn or nnn or ...
// n$  end of string
// ^n  beginning of string

// a(?=b) match a if is follow by b (b is not selected)
// a(?!b) match a if is NOT follow by b (b is not selected)
// (?<=a)b b is matched if a exists (a is not selected)
// (?<!a)b b is not matched if a exists (a is not selected)

//(?:regex) // match and name group
(/(a.)(b.)/g).exec("acbc"); // () create capture groups
(/(?:a.)(?:b.)/g).exec("acbc"); // () not create capture groups

//(?<group_name>regex) // match and name group
var m = (/(?<group1>aa)(?<group2>bb)/g).exec("aabb"); // match groups in string
m.groups.group1 // named group match
m.groups.group2
m[0]; // whole string match
m[1]; // group1 match
m[2]; // group2 match