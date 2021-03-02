<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Vue</title>
        <script src="./node_modules/vue/dist/vue.min.js"></script>
    </head>

    <body>
        <div id="app">
            <input type="text" v-model="message"><br><br>

            {{ message }} <br><br>

            <component1 param1="static param message" @custom-message="childMessageRecived"></component1>

            <component2 :param1="message"></component2>

        </div>

        <script>
            Vue.component('component1', {
                props: {
                    param1: String
                },
                methods: {
                    sendMessageToParent() {
                        console.log("click");
                        this.$emit("custom-message", 1, 2, 3); // no camel case allowed (use - instead)
                    }
                },
                data: function () {
                    return {
                        message: "component1",
                    }
                },
                template: '<div><button v-on:click="sendMessageToParent" >Send Message To Parent</button> <input type="text" v-model="message"> {{param1}} </div>'
            });

            Vue.component('component2', {
                props: {
                    param1: String
                },
                data: function () {
                    return {
                        message: "component2",
                    }
                },
                template: '<div><input type="text" v-model="message" > {{param1}}<component3 :param1="param1"></component3 ></div>'
            });

            Vue.component('component3', {
                props: {
                    param1: String
                },
                watch: {
                    'param1': function() {
                        this.afterParam1Update();
                    }
                },
                methods: {
                    afterParam1Update() {
                        console.log("component3: param1: update");
                    },
                    sendMessageToAll() {
                        console.log("click2");
                        this.$root.$emit("custom-message-to-all", 1, 2, 3);
                    }
                },
                data: function () {
                    return {
                        message: "component3",
                    }
                },
                template: '<div><button v-on:click="sendMessageToAll" >Send Message To All</button><input type="text" v-model="message" > {{param1}}</div>'
            });

            var app = new Vue({
                el: '#app',
                data: {
                    message: "message",
                },
                mounted(){
                    this.$root.$on('custom-message-to-all', (a, b, c) => {
                        console.log('Custom message from all');
                    });
                },
                methods: {
                    childMessageRecived(arg1, arg2, arg3) {
                        console.log("app: param1: update");
                    }
                }
            });
        </script>
    </body>
</html>
