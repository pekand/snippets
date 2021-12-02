<!DOCTYPE html>
<html lang="en">
    <meta charset="utf-8">
    <title>Login page</title>
    <main>
        <h1>Login form</h1>
        <form action="" method="post">
            <input type="hidden" name="csrf_token" value="<?= @$_SESSION['csrf_token'] ?>">
            <input type="text" name="username">
            <input type="password" name="password">
            <input type="checkbox" name="stay-sign-in"><label for="chceckbox1">Stay sign in</label>
            <input type="submit" name="login">
        </form>
    </main>
</html>
