<template>
  <li>{{ todo.name }}</li>
</template>

<script>
export default {
    name: 'Todo',
    props: [
        'todo'
    ],
    data: function() {
        return {
            
        }
    },
    methods: {
        action1: function () {
          
        }
    }
}
</script>

<style scoped>

</style>
