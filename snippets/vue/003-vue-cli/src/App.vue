<template>
  <div id="app">
    <component1 msg="test"></component1>
  </div>
</template>

<script>
import Component1 from './components/Component1.vue'

export default {
  name: 'App',
  components: {
    Component1
  }
}
</script>

<style>
#app {

}
</style>
