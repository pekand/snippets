<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Vue</title>
    <script src="./node_modules/vue/dist/vue.min.js"></script>    
  </head>
  <body>
    <div id="app">
        <h3>Array render example</h3>

        <button v-on:click="pushItem">pushItem</button><br>
        <button v-on:click="popItem">popItem</button><br>
        
        <button v-on:click="shiftItem">shiftItem</button><br>
        <button v-on:click="unshiftItem">unshiftItem</button><br>

        <button v-on:click="spliceItem">spliceItem</button><br>

        <button v-on:click="sortItem">sortItem</button><br>
        <button v-on:click="reverseItem">reverseItem</button><br>
        <button v-on:click="filterItem">filterItem</button><br>
        <button v-on:click="concatItem">concatItem</button><br>
        <button v-on:click="sliceItem">sliceItem</button><br>

        <ul>
            <li v-for="item in items" v-bind:key="item.id" >{{ item.name }}</li>
        </ul>

        <ul>
            <li v-for="item of items" v-bind:key="item.id" >{{ item.name }}</li>
        </ul>

        <ul>
            <li v-for="(item, index) in items" v-bind:key="item.id" >{{ index }} - {{ item.name }}</li>
        </ul>

        <ul>
            <li v-for="(value, name) in obj" >{{ name }}: {{ value }}</li>
        </ul>

        <ul>
            <li v-for="(value, name, index) in obj" >{{ name }}({{ index }}): {{ value }}</li>
        </ul>

        <ul>
            <li v-for="item in alwaysSorted" v-bind:key="item.id" >{{ item.name }}</li> <!-- use computed array -->
        </ul>

        <ul>
            <li v-for="n in 5">{{ n }}</li><!-- for in range -->
        </ul>

        <ul>
            <template v-for="item in items"> <!-- group multiple tag for one iteration -->
              <li>{{ item.name }}</li>
              <li>----</li>
            </template>
        </ul>

        <ul>
            <li v-for="n in 5" v-if="n !== 3">{{ n }}</li><!-- for with if - for has higger priority -->
        </ul>
        

        
    </div>

    <script>
        var app = new Vue({
          el: '#app',
          data: {
            itemsCount: 3,
            items: [
              { id: 0, name: 'item1' },
              { id: 1, name: 'item2' },
              { id: 2, name: 'item3' }
            ],
            obj: {
              a:'value1',
              b:'value2',
              c:'value3',
            }
          },
          computed: {
            alwaysSorted: function () {
              return this.items.slice().sort(function(a, b) {
                    if (a.name < b.name) {
                      return -1;
                    }
                    if (a.name > b.name) {
                      return 1;
                    }
                    return 0;
                });
            }
          },
          methods: {
            pushItem: function () {
                this.items.push({ id: ++this.itemsCount, name: 'item'+this.itemsCount });
                //items.splice();
            },
            popItem: function () {
                let item = this.items.pop();
            },

            shiftItem: function () {
                let item = this.items.shift();
            },

            unshiftItem: function () {
                this.items.unshift({ id: ++this.itemsCount, name: 'item'+this.itemsCount });
            },

            spliceItem: function () {
                // replace first 2 items with other two items
                this.items.splice(0,2, { id: ++this.itemsCount, name: 'item'+this.itemsCount }, { id: ++this.itemsCount, name: 'item'+this.itemsCount } );
            },

            sortItem: function () {
                this.items.sort(function(a, b) {
                    if (a.name < b.name) {
                      return -1;
                    }
                    if (a.name > b.name) {
                      return 1;
                    }
                    return 0;
                });
            },
            reverseItem: function () {
                this.items.reverse();
            },

            filterItem: function () {
                this.items = this.items.filter(function (item) { // rerender onli changed elements not whole array
                  return item.name.match(/item3/);
                });
            },
            concatItem: function () {
                this.items = this.items.concat(this.items);
            },
            sliceItem: function () {
                this.items = this.items.slice(1,3);
            },

          },
        });
    </script>
  </body>
</html>
