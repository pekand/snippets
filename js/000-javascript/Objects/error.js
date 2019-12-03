
try {
  adddlert("Welcome");
}
catch(err) {
    err.name;
    err.message;

    /* not standardized ( not work in all browsers)*/
    err.fileName();
    err.lineNumber();
    err.columnNumber();
    err.stack();
    err.description();
    err.number();
}