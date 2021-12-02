<!DOCTYPE html>
<html lang="en">
    <meta charset="utf-8">
    <title>Register new account</title>
    <main>
        <h1>Register new account</h1>
        <form action="register-user.php" method="post">
            <input type="hidden" name="csrf_token" value="<?= @$_SESSION['csrf_token'] ?>">
            <input type="text" name="username">
            <input type="text" name="email">
            <input type="password" name="password-new">
            <input type="password" name="password-repeat">
            <input type="submit" name="Register">
        </form>
    </main>
</html>

