<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Vue</title>
    <script src="./node_modules/vue/dist/vue.min.js"></script>    
  </head>
  <body>
    <div id="app">
        <h3>bind tag attribute example</h3>
        <a v-bind:href="url"> ... </a>
        <a v-bind:[attributename]="url"> ... </a>

        <h3>custom dynamic id example</h3>
        <span v-bind:id="dynamicId"> ... </span>
        <span v-bind:id="'list-' + dynamicId"> ... </span>

        <h3>disable button  example</h3>
        <button v-bind:disabled="isButtonDisabled">Button</button>
    
    </div>

    <script>
        var app = new Vue({
          el: '#app',
          data: {
            dynamicId: "customid",
            attributename: 'href',
            url:'/',
             isButtonDisabled: true,
          }
        });
    </script>
  </body>
</html>
