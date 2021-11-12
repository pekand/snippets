<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Vue</title>
        <script src="./node_modules/vue/dist/vue.min.js"></script>
    </head>

    <body>
        <div id="app">
            <component1></component1>
        </div>

        <script>
            Vue.component('component1', {
                props: {
                    param1: String
                },
                methods: {
                    calcRatio() {
                        if (this.ratio1_value1 == "") {
                            this.ratio1_value1 = this.ratio1_value2 * ( this.ratio2_value1 / this.ratio2_value2);
                        }
                        if (this.ratio1_value2 == "") {
                            this.ratio1_value2 = this.ratio1_value1 / ( this.ratio2_value1 / this.ratio2_value2);
                        }
                        if (this.ratio2_value1 == "") {
                            this.ratio2_value1 = this.ratio2_value2 * ( this.ratio1_value1 / this.ratio1_value2);
                        }
                        if (this.ratio2_value2 == "") {
                            this.ratio2_value2 = this.ratio2_value1 / ( this.ratio1_value1 / this.ratio1_value2);
                        }
                        this.message = "";
                    }
                },
                data: function () {
                    return {
                        ratio1_value1: 1,
                        ratio1_value2: 1,
                        ratio2_value1: 1,
                        ratio2_value2: 1,
                        message: "",
                    }
                },
                watch: {
                    ratio1_value1: function(val, oldVal) {
                        //this.ratio2_value1 = this.ratio1_value1 * ( this.ratio2_value1 / this.ratio2_value2);
                    },
                    ratio1_value2: function(val, oldVal) {
                        //this.ratio2_value2 = this.ratio1_value2 * ( this.ratio2_value1 / this.ratio2_value2);
                    },
                    ratio2_value1: function(val, oldVal) {
                        //this.ratio2_value2 = this.ratio2_value1 * ( this.ratio1_value1 / this.ratio1_value2);
                    },
                    ratio2_value2: function(val, oldVal) {
                        //this.ratio2_value1 = this.ratio2_value2 * ( this.ratio1_value1 / this.ratio1_value2);
                    }
                },
                template: `<div>
                    <input type="text" v-model="ratio1_value1"> : <input type="text" v-model="ratio1_value2"> = 
                    <input type="text" v-model="ratio2_value1"> : <input type="text" v-model="ratio2_value2">
                    <button v-on:click="calcRatio" >calc</button> <br>
                    {{ message }} 
                    </div>`
            });

            var app = new Vue({
                el: '#app',
                data: {
                    message: "message",
                },
                mounted(){

                },
                methods: {
                }
            });
        </script>
    </body>
</html>
