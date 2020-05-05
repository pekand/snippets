<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Vue</title>
    <script src="./node_modules/vue/dist/vue.min.js"></script>    
  </head>
  <body>
    <div id="app">
        message: <input v-model="message" type="text"> <br><br>

        {{ message }} <br><br>
    </div>

    <script>
        var app = new Vue({
          el: '#app',
          data: {
            message: "message",
          }
        });
    </script>
  </body>
</html>
