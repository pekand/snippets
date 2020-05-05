<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Vue</title>
    <script src="./node_modules/vue/dist/vue.min.js"></script>    
  </head>
  <body>
    <div id="app">
        <h3>Array render example</h3>
        <ul>
            <li v-for="item in items" v-bind:key="item.id" >{{ item.name }}</li>
        </ul>
    </div>

    <script>
        var app = new Vue({
          el: '#app',
          data: {
            items: [
              { id: 0, name: 'item1' },
              { id: 1, name: 'item2' },
              { id: 2, name: 'item3' }
            ]
          }
        });
    </script>
  </body>
</html>
