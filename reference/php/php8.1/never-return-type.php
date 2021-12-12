<?php 

function redirect(string $uri): never { // function if finished by exit or die, never by return
    header('Location: ' . $uri);
    exit();
}

function redirectToLoginPage(): never { // function never finish  by return
    redirect('/login');
    echo 'Hello';
}


function test(): never {
    // return 1;  # cuse: Fatal error: A never-returning function must not return
}
