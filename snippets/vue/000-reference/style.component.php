<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Vue</title>
    <script src="./node_modules/vue/dist/vue.min.js"></script>    
  </head>
  <body>
    <div id="app">
        <h3>Apply class to component</h3>
        <ul>
            <item v-for="item in items" v-bind:key="item.id" v-bind:item="item" class="c d" v-bind:class="{ error: true }"></item><!-- add classies to component (not override existing classies on li tag) -->
        </ul>
    </div>

    <script>
       Vue.component('item', {
            props: ['item'],
            template: '<li class="a b" v-bind:class="{ atcive: true }">{{ item.name }}</li>'
       });

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
