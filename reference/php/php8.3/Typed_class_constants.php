<?php

interface I {
    const string PHP = 'PHP 8.3';  // set constant with type
}

class Foo implements I {
    const string PHP = [];
}

// result Fatal error: Cannot use array as value for class constant Foo::PHP of type string in C:\Documents\Projects\github\snippe