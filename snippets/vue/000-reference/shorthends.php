<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Vue</title>
    <script src="./node_modules/vue/dist/vue.min.js"></script>    
  </head>
  <body>
    <div id="app">
        <h3>Shorthends</h3>
        <a v-bind:href="url"> example </a> <br><br>
        <a :href="url"> example </a> <br><br>
        <a :[attributename]="url"> example </a> <br><br>

        <button v-on:click="click"> example </button> <br><br>
        <button @click="click"> example </button> <br><br>
        <button @[eventName]="click"> example </button> <br><br>
    </div>

    <script>
        var app = new Vue({
          el: '#app',
          data: {
            message: "message",
            url:'/',
            attributename: 'href',
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
