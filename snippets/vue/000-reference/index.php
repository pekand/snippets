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
        {{ messageSetterGetter }} <br><br>
        {{ message.split('').reverse().join('') }} <br><br>
        {{ messageWatch }} <br><br>
            
        <input v-model="number" type="text"> <br><br>

        {{ number + 1 }} <br><br>
        {{ ok ? 'YES' : 'NO' }} <br><br>

        <h3>insert raw html example</h3>
        <span v-html="rawHtml"></span>

        <h3>bind tag attribute example</h3>
        <a v-bind:href="url"> ... </a>
        <a v-bind:[attributename]="url"> ... </a>

        <h3>custom dynamic id example</h3>
        <span v-bind:id="dynamicId"></span>
        <span v-bind:id="'list-' + dynamicId"></span>

        <h3>bind event example</h3>
        <button v-on:click="click">Change it</button>
        <button v-on:[eventName]="click"> ... </button>

        <h3>disable button  example</h3>
        <button v-bind:disabled="isButtonDisabled">Button</button>
    
        <h3>Shorthends</h3>
        <a v-bind:href="url"> example </a>
        <a :href="url"> example </a>
        <a :[attributename]="url"> example </a>

        <button v-on:click="click"> example </button>
        <button @click="click"> example </button>
        <button @[eventName]="click"> example </button>

        <h3>Computed properties example</h3>
        {{ messageComputed }} <!-- rerender only if messae change -->
        {{ messageMethod() }} <!-- rerender if some data change -->

        <h3>Form example</h3>
        <form v-on:submit.prevent="onSubmit">
            <input type="text">
            <input type="submit">
        </form>

        <h3>if directive  example</h3>
        <p v-if="ok">some text</p>

        <h3>Array render example</h3>
        <ul>
            <todo v-for="item in todos" v-bind:todo="item" v-bind:key="item.id"></todo>
        </ul>

    </div>

    <script>
        Vue.component('todo', {
            props: ['todo'],
            template: '<li>This is a todo</li>'
        });

        var app = new Vue({
          el: '#app',
          data: {
            message: "message",
            messageWatch: '',
            rawHtml: "<h1>Title</h1>",
            dynamicId: "customid",
            isButtonDisabled: true,
            number: 1,
            ok: true,
            attributename: 'href',
            url:'/',
            eventname: 'click',
            todos: [
              { id: 0, text: 'Vegetables' },
              { id: 1, text: 'Cheese' },
              { id: 2, text: 'Whatever else humans are supposed to eat' }
            ]
          },
          created: function () {
            console.log('ceated');
          },
          mounted: function () {
            console.log('mounted');
          },
          updated: function () {
            console.log('updated');
          }, 
          destroyed: function () {
            console.log('destroyed');
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
            }
          },
          methods: {
            click: function () {
                console.log('click');
            },
            onSubmit: function () {
                console.log('submit');
            },
            messageMethod: function () {
                console.log('messageMethod');
                return this.message.split('').reverse().join('')
            }   ,
          },
          watch: {
            message: function (val) {
              console.log('messageMethod');
              this.messageWatch = '(' + this.message + ' ' + this.message + ')';
            },
          }
        })

        app.$data;
        app.$el;
        app.$watch('message', function (newValue, oldValue) {
            console.log('message has changed ');
        })

    </script>
  </body>
</html>
