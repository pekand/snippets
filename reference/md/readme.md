# Markdown syntax guide

## Headers

# This is a Heading h1
## This is a Heading h2 
###### This is a Heading h6

Underline Heading H1
====================

Underline Heading H2
--------------------

## Emphasis

*text italic*  
_text italic_

**text bold**  
__text bold__

_italic **bold** italic_

~~strike through~~

## Lists

### Unordered

* Unordered list item 1
* Unordered list item 2
  * Unordered list item 2a
  * Unordered list item 2b

- Unordered list item 1
- Unordered list item 2
- Unordered list item 3

### Ordered

1. Ordered list item 1
1. Ordered list item 2
1. Ordered list item 3
   1. Ordered list item 3a
   1. Ordered list item 3b

## Images

![image alt text](https://dummyimage.com/100x100/000/fff "image title text")

Image with reference:

![image alt text][image]

Reference:

[image]: https://dummyimage.com/100x100/000/fff "image title text"

## Links

[Link text](https://www.google.com)

[Link text][link reference]

[Link to file text](../LICENSE.md)

[Link use number reference][1]

[link use reference]

Inline links automaticaly generated https://www.google.com or <https://www.google.com>

References:

[link reference]: https://www.google.com
[1]: https://www.google.com
[link use reference]: https://www.google.com

## Blockquotes

> tiam vitae elementum turpis. In non magna arcu. Duis semper dolor sed lectus vehicula maximus. In vulputate fermentum ipsum.

Quote break.

> Aliquam molestie sollicitudin venenatis. Pellentesque sagittis turpis non tortor pharetra, vel tincidunt diam interdum. Aenean ut convallis ex, ut euismod leo. 
>
>> Fusce turpis dolor, fermentum non aliquam sed, tincidunt vitae dolor. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vestibulum id hendrerit odio. E

## Horizontal Rule

Text

---

Hyphens

***

Asterisks

___

Underscores

## Table

| Header1      | Header2       | Header3    |
| -----------  | :-----------: |-----------:|
| Text1        | Text3         |$1000       |
| Text2        | Text4         |$10         |


Header1 | Header2 | Header3
--- | --- | ---
Text1 | Text2 | Text3
1 | 2 | 3


## Inline code

Inline code `markedjs/marked`.

## Fenced Code Block

```
{
  "firstName": "John",
  "lastName": "Smith",
  "age": 25
}


```javascript
var s = "JavaScript syntax highlighting";
alert(s);
```
 
```python
s = "Python syntax highlighting"
print s
```

## Task List

- [x] Write the press release
- [ ] Update the website
- [ ] Contact the media

## Video


<a href="http://www.youtube.com/watch?feature=player_embedded&v=dQw4w9WgXcQ
" target="_blank"><img src="http://img.youtube.com/vi/dQw4w9WgXcQ/0.jpg" 
alt="IMAGE ALT TEXT HERE" width="240" height="180" border="10" /></a>


[![IMAGE ALT TEXT HERE](http://img.youtube.com/vi/dQw4w9WgXcQ/0.jpg)](http://www.youtube.com/watch?v=dQw4w9WgXcQ)


## Inline HTML

<div>
    <img src="https://dummyimage.com/100x100/000/fff" alt="alt text" title="title text"><br>
    <a href="https://www.google.com">google</a><br>
    <span>## Inline HTML</span>
</div>

<pre>
    ## Inline HTML
</pre>

<table>
    <tr>
        <td>1</td>
        <td>2</td>
        <td>3</td>
    </tr>
</table>

<ul>
    <li>item1</li>
    <li>item2</li>
    <li>item3</li>
</ul>

<dl>
  <dt>Definition list</dt>
  <dd>Is something people use sometimes.</dd>

  <dt>Markdown in HTML</dt>
  <dd>Does *not* work **very** well. Use HTML <em>tags</em>.</dd>
</dl>
