<!DOCTYPE html>
<html lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="Description" content="description here.">
    <title>Page</title>
    <link rel="shortcut icon" href="favicon.ico" />
    <style type="text/css"></style>

    <main>
        iframe
    </main>
    <script>
        if (localStorage.getItem("item-iframe") == null) {
            localStorage.setItem("item-iframe", Date.now());
        }

        console.log(localStorage.getItem("item-iframe")); // items is saved in context of first parent page 
    </script>
</html>
