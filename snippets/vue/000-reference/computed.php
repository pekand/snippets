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

        <h3>Computed properties example</h3>
        {{ messageComputed }}  <br><br><!-- rerender only if messae change -->
        {{ messageMethod() }}  <br><br><!-- rerender if some data change -->

        {{ messageSetterGetter }}  <br><br>
    </div>

    <script>
        var app = new Vue({
          el: '#app',
          data: {
            message: "message",
          },
          computed: {
            messageComputed: function () {
              console.log('messageComputed');
              return this.message.split('').reverse().join('');
            },
            messageSetterGetter: {
                get: function () {
                  console.log('messageSetterGetter get');
                  return '[' + this.message + ']';
                },
                set: function (value) {
                    console.log('messageSetterGetter set');
                    this.message = value;
                }
            },
          },
          methods: {
              messageMethod: function () {
                  console.log('messageMethod');
                  return this.message.split('').reverse().join('')
              },
            }
        });
    </script>
  </body>
</html>
