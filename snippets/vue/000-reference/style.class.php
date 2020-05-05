<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Vue</title>
    <script src="./node_modules/vue/dist/vue.min.js"></script>    
  </head>
  <body>
    <div id="app">
        <h3>Class binding</h3>
        <button v-on:click="isActive = !isActive">Toggle Active</button><br><br>
        <button v-on:click="hasError = !hasError">Toggle Error</button><br><br>
        <div class="block" v-bind:class="{ active: isActive, error: hasError}">Block1</div><br><br>

        <h3>Apply class wrom data attribute</h3>
        <div class="block" v-bind:class="[ activeClass, errorClass]">Block5</div><br><br>
        <div class="block" v-bind:class="[ (isActive)?activeClass:'', (hasError)?errorClass:'']">Block6</div><br><br>
        <div class="block" v-bind:class="[ {active:isActive}, (hasError)?errorClass:'']">Block7</div><br><br>

        <h3>Groups on block</h3>
        <button v-on:click="groupOfClassies.active = !groupOfClassies.active">Toggle Active</button><br><br>
        <button v-on:click="groupOfClassies.error = !groupOfClassies.error">Toggle Error</button><br><br>
        <div class="block" v-bind:class="groupOfClassies" >Block2</div><br><br>

        <h3>Computed groups on block</h3>
        <div class="block" v-bind:class="computedGroupOfClassies" >Block3</div><br><br>
  
        <h3>Multiple groups on block</h3>
        <div class="block" v-bind:class="[groupOfClassies, computedGroupOfClassies]" >Block4</div><br><br>
    </div>

    <script>
        var app = new Vue({
          el: '#app',
          data: {
            activeClass: 'active',
            errorClass: 'error',

            isActive : true,
            hasError: false,
            groupOfClassies: {
              active : true,
              error: false,
            }
          },
          computed: {
            computedGroupOfClassies: function () {
              return {
                active: this.isActive && !this.hasError,
                'error': this.hasError
              }
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
