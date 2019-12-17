var pattern = /^.*$/g;
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
s.matchAll(pattern);
s.replace(pattern, "value");
s.search(pattern);

// ^ beggining of string
// $ end of string

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

// modificator g change resylt of match function
"aaaa abababab aaaa".match(/(a)(b)/g); // teturn allmatchies on string, dont return groups ["ab", "ab", "ab", "ab"]

"aaaa abababab aaaa".match(/(a)(b)/); // find first match and groups ["ab", "a", "b", index: 5, input: "xxxx abababab xxxx", groups: undefined] (0 is full match 1,2 are groups, index is positions. groups are named groups  )

var matches = "aaaa abababab aaaa".matchAll(/(a)(b)/g); // return iterator for all matchies and groups
for (const match of matches) {
  console.log(match);
}

var regex = RegExp('(a)(b)','i');
regex.exec("aaaa abababab aaaa"); // result ["ab", "a", "b", index: 5, input: "xxxx abababab xxxx", groups: undefined] 

var regex = RegExp('(a)(b)','i');
regex.test("aaaa abababab aaaa"); // return true; check if match in string exists

var regex = RegExp('(a)(b)','i');
regex.toString(); // return "/(a)(b)/i"

//replace groups in string
'aaaa abababab aaaa'.replace(/(a)(b)/g, " $1$2 ");
// $$ escape $
// $& matched string
// $1-$n matched groups
// $` insert string whitch is before matched string (from original string not replaced)
'ababababab'.replace(/(a)(b)/g, " $` "); // return "   ab  abab  ababab  abababab "
// $' insert string whitch is after matched string
'ababababab'.replace(/(a)(b)/g, " $' "); // return " abababab  ababab  abab  ab   "

//replace function
function replacer(match, g1, g2, offset, string) {
  console.log(match, g1, g2, offset, string);
  return "replace with";
}
'aaaa abababab aaaa'.replace(/(a)(b)/g, replacer);