window.alert("alert\nmessage");
        
if (confirm("confirm")) {
  alert("yes");
} else {
  alert("no");
}


var res = prompt("Question", "default value");
if (res == null || res == "") {
  alert("cancled");
} else {
  alert(res);
}
