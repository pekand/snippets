<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Vue</title>
    <script src="./node_modules/vue/dist/vue.min.js"></script>    
  </head>
  <body>
    <div id="app">
        <h3>bind event example</h3>
        <button v-on:click="click">Button1</button>
        <button v-on:[eventName]="click">Button2</button>
    </div>

    <script>
        var app = new Vue({
          el: '#app',
          data: {
            message: "message",
            eventname: 'click',
          },
          methods: {
            click: function () {
                console.log('click');
            },
          },
        });
    </script>
  </body>
</html>
