<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Vue</title>
    <script src="./node_modules/vue/dist/vue.min.js"></script>    
  </head>
  <body>
    <div id="app">

        <h3>if directive  example</h3>
        <button v-on:click="displayText = !displayText">Toggle</button>
        <p v-if="displayText">some text</p>
    </div>

    <script>
        var app = new Vue({
          el: '#app',
          data: {
            displayText: true,
          }
        });
    </script>
  </body>
</html>
