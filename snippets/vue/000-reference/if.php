<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Vue</title>
    <script src="./node_modules/vue/dist/vue.min.js"></script>    
  </head>
  <body>
    <div id="app">

        <h3>if directive  example</h3>

        <button v-on:click="displayText = !displayText">Toggle</button>
        <button v-on:click="displayText2 = !displayText2">Toggle2</button>

        <p v-if="displayText">some text</p><!-- render onli if is true -->
        <p v-else-if="displayText2">custom text</p>
        <p v-else>other text</p>


        <template v-if="displayText"><!-- use template as group for multiple lements -->
          <h1>Title</h1>
          <p>Paragraph 1</p>
          <input placeholder="Name">
          <input placeholder="Email" key="value1"> 
        </template>
        <template v-else>
          <h1>Title</h1>
          <p>Paragraph 1</p>
          <input placeholder="Name"> <!-- reuse input from first part of if (same value other atribbutes)-->
          <input placeholder="Username" key="value2"> <!-- without key is input reuset after toggle (value of input is not changed by toggle) -->
        </template>


        <h1 v-show="displayText">Title2</h1> <!-- use display: none; to hidde element -->

    </div>

    <script>
        var app = new Vue({
          el: '#app',
          data: {
            displayText: true,
            displayText2: false,
          }
        });
    </script>
  </body>
</html>
