<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Vue</title>
    <script src="./node_modules/vue/dist/vue.min.js"></script>    
  </head>
  <body>
    <div id="app">
        <div class="block" v-bind:style="{ backgroundColor: 'green' }">Inline style</div>
        <div class="block" v-bind:style="styleObject">Inline style set by style data group</div>
        <div class="block" v-bind:style="[styleObject, styleObject2]">Multiple stle data groups</div>
        <div class="block" v-bind:style="{ display: ['-webkit-box', '-ms-flexbox', 'flex'] }">Auto prefix inline style with browser supprt detect</div>
    </div>

    <script>
        var app = new Vue({
          el: '#app',
          data: {
            backgroundColor: 'red',
            styleObject: {
              backgroundColor: 'blue',
            },
            styleObject2: {
              backgroundColor: 'red',
            }
          }
        });
    </script>

    <style type="text/css">
        .block {
          padding: 10px;
          margin: 10px;
        }
        .active {
          background-color: blue;
        }

        .error {
          background-color: red;
        }
    </style>
  </body>
</html>
