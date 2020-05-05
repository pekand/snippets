<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Vue</title>
    <script src="./node_modules/vue/dist/vue.min.js"></script>    
  </head>
  <body>
    <div id="app">

        <h3>expressions example</h3>
        message: <input v-model="message" type="text"> <br><br>

        {{ message }} <br><br>
        {{ message.split('').reverse().join('') }} <br><br>
            
        <input v-model.number="number" type="number"> <br><br>

        {{ number + 1 }} <br><br>
        {{ ok ? 'YES' : 'NO' }} <br><br>

    </div>

    <script>
        var app = new Vue({
          el: '#app',
          data: {
            message: "message",
            number: 1,
            ok: true,
          }
        })

    </script>
  </body>
</html>
