<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Cros origin</title>
  </head>
  <body>

    <script>
        async function postData(method='POST', url = '', data = {}) {
          const response = await fetch(url, {
            method: 'POST', 
            cache: 'no-cache',
            credentials: 'include',
            headers: {
              'Content-Type': 'application/json',
              'Accesstoken': 'a5e4e0f33c610bd9645d010e979cff218c5b4f9ed00525c5254a140d6eb183b123'
            },
            body: JSON.stringify(data)
          });
          return response.json();
        }

        postData('POST', 'https://snippets2.loc/snippets/php/016-cros-origin/backend.php', {a:1,b:2}).then(data => console.log(data));
    </script>
  </body>
</html>
