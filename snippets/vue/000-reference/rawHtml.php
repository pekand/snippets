<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Vue</title>
    <script src="./node_modules/vue/dist/vue.min.js"></script>    
  </head>
  <body>
    <div id="app">
        <h3>insert raw html example</h3>
        <span v-html="rawHtml"></span>
    </div>

    <script>
        var app = new Vue({
          el: '#app',
          data: {
            rawHtml: "<h1>Title</h1>",
          }
        });
    </script>
  </body>
</html>
