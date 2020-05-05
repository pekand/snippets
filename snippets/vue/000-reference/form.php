<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Vue</title>
    <script src="./node_modules/vue/dist/vue.min.js"></script>    
  </head>
  <body>
    <div id="app">
        <h3>Form example</h3>
        <form v-on:submit.prevent="onSubmit">
            <input type="text">
            <input type="submit">
        </form>
    </div>

    <script>
        var app = new Vue({
          el: '#app',
          data: {
          },
          methods: {
            onSubmit: function () {
                console.log('submit');
            }
          },
        });
    </script>
  </body>
</html>
