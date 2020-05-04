<template>
  <div class="hello">
    <h1>{{ msg }}</h1>

    <input type="text" v-bind:value="inputValue"><br>
     <input type="text" v-model="inputValue"><br>

    <span v-if="showMessage">Now you see me</span><br>

    <ul>
        <li v-for="item in items" v-bind:key="item.id">
      {{ item.name }}
    </li>
    </ul>

     <todo
      v-for="item in items"
      v-bind:todo="item"
      v-bind:key="item.id"
    ></todo>

    <button v-on:click="reverseMessage">Button</button>

  </div>
</template>

<script>
import Todo from './Todo.vue'

export default {
    name: 'Component1',
    props: {
        msg: String
    },
    components: {
        Todo
    },
    data: function() {
        return {
            inputValue: "value",
            showMessage: true,
            items: [
              { id:1, name: 'item1' },
              { id:2, name: 'item2' },
              { id:3, name: 'item3' }
            ],
        }
    },
    methods: {
        reverseMessage: function () {
          this.inputValue = this.inputValue.split('').reverse().join('')
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
