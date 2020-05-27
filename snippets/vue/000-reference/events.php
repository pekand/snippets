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
        <button v-on:click="click2($event, 'Button2')">Button2</button>

        <button v-on:click.stop="click">Button3</button> <!-- stop propagation will -->
        <button v-on:[eventName]="click">Button3</button>

        <form v-on:submit.prevent="click"><input type="submit" value='Submit'></form> <!-- stop propagation will -->
        <form v-on:submit.prevent><input type="submit" value='Submit'></form>
        <a v-on:click.stop.prevent="click">Link1</a> <!-- chained modifiers -->
        <div v-on:click.capture="click">Block1</div>
        <div v-on:click.self="click">Block2</div> <!-- if event.target is the element itself -->

        <div v-on:click.self.prevent="click">Block3</div> <!-- prevent clicks on the element -->
        <div v-on:click.prevent.self="click">Block4</div> <!-- prevent all clicks -->

        <a v-on:click.once="click">Once time event</a>

        <div v-on:scroll.passive="onScroll">Passive</div>

        <input v-on:keyup.enter="keyup1">Catch enter key in inut <br> <!-- .enter .tab .delete .esc .space .up .down .left .right  or number value .13  .ctrl .alt .shift .meta -->

    </div>

    <script>
        Vue.config.keyCodes.f1 = 112; // define custom key 

        var app = new Vue({
          el: '#app',
          data: {
            message: "message",
            eventname: 'click',
          },
          methods: {
            click: function (ev) {
                console.log('click');
                console.log(ev);
            },
            click2: function (ev, value) {
                console.log(value);
                console.log(ev);
            },
            keyup1: function () {
                console.log('keyup');
            },
          },
        });
    </script>
  </body>
</html>
