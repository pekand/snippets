<template>
    <div>
        I'm an example component. 11234 {{ test }}
    </div>
</template>

<script>
    export default {
        name: "component1",
        props: {
            article: { type: Object, required: true },
            canModify: { type: Boolean, required: true }
          },
        data: function() {
            return {
                test: 'test1'
            }
        },
        computed : {
            
        },
        mounted() {
            console.log('Component mounted.')
            console.log(this.$options.name);
            this.method1();
        },
        methods:{
          method1 : function() {
             this.test = "test2";
          }
        },
        components: {
        }
    }
</script>
