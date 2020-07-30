<!DOCTYPE html>
<html lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="Description" content="description here.">
    <title>Page</title>
    <main>
        <iframe src="https://snippets2.loc/snippets/js/026-localstorage-cross-origin/iframe.php" frameborder="0"></iframe>
    </main>
    <script>
        if (localStorage.getItem("item-index") == null) {
            localStorage.setItem("item-index", Date.now());
        }
        console.log(localStorage.getItem("item-index"));
    </script>
</html>
