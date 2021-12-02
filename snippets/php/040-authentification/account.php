<?php

    include "lib.php";
    protectPage();

?><!DOCTYPE html>
<html lang="en">
    <meta charset="utf-8">
    <title>Client account</title>
    <main>
        <h1>Client account</h1>
        <form action="account-save.php" method="post">
            <input type="hidden" name="csrf_token" value="<?= @$_SESSION['csrf_token'] ?>">
            <input type="password" name="password-old">
            <input type="password" name="password-new">
            <input type="password" name="password-repeat">
            <input type="submit" name="Change password">
        </form>
    </main>
</html>

