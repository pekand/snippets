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
        {{ messageWatch }} <br><br>
    </div>

    <script>
        var app = new Vue({
          el: '#app',
          data: {
            message: "message",
            messageWatch: '',
          },
          watch: {
            message: function (val) {
              console.log('message has changed 2');
              this.messageWatch = 'new ' + this.message;
            },
          }
        });

        app.$watch('message', function (newValue, oldValue) {
            console.log('message has changed 1');
        })
    </script>
  </body>
</html>
