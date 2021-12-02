<?php

    include "lib.php";
    protectPage();

?><!DOCTYPE html>
<html lang="en">
    <meta charset="utf-8">
    <title>Secret Page</title>
    <main>
        <h1>Some secret data only for logged user</h1>
        <p> <a href="logout.php">logout</a> <a href="account.php">account</a></p>
    </main>
</html>

