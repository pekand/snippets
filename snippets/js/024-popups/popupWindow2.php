<!DOCTYPE html>
<html lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="Description" content="description here.">
    <title>Page</title>
    <link rel="shortcut icon" href="favicon.ico" />
    <style type="text/css"></style>

    <main>
        popup
    </main>
    <script>
        function init() {
           window.opener.document.getElementById('info').innerHTML = 'Message from popup window';
        }

        window.addEventListener("load", init);
    </script>
</html>
