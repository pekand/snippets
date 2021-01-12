var swWorker = {
    version: 'v1.0.6',
    init: function () {
        this.id = 0;
        this.channels = {};
        this.bindEvents();
        return this;
    },

    bindEvents: function() {
        self.addEventListener('message', this.recieveMessage.bind(this));
        self.addEventListener('fetch', this.fetchEvent.bind(this));
    },

    recieveMessage: function(event) {
        console.log('Message from client:', event.data);

        var data = event.data;

        if(data.action === 'init') {
            var id = event.data.id;
            this.channels[id] = new BroadcastChannel(id);
            this.channels[id].onmessage = function (ev) { 
                this.recieveBroadcastMessage(ev, id); 
            }.bind(this);

            this.sendBroadcastMessage(id, {
                action: 'id', 
                id: id,
                version: this.version
            });
        }
    },

    sendMessage: function(message) {
        self.clients.matchAll().then(clients => {
            clients.forEach(client => client.postMessage(message));
        });
    },

    recieveBroadcastMessage: function(event, id) {
        console.log('Broadcast message from client:', id, event.data);

        var data = event.data;

        if(data.action === 'unload') {
            this.channels[id] = null;
        }

        if(data.action === 'clearCache') {
            this.clearCacheAll();
        }

        if(data.action === 'ping') {
            this.sendBroadcastMessage(id, {
                action: 'pong'
            });
        }
    },

    sendBroadcastMessage: function(id, message) {
        console.log('Broadcast message to client:', id, message);
        this.channels[id].postMessage(message);
    },

    fetchEvent: function(event) {
      if (event.request.method != 'GET') return;

        event.respondWith(async function() {

        const cache = await caches.open('offline');

        if(navigator.onLine) {
            return fetch(event.request).then(function(response) {
              cache.put(event.request, response.clone());
              return response;
            });
        } else {
            const cachedResponse = await cache.match(event.request);
            if (cachedResponse) {
              return cachedResponse;
            }
        }

      }());
    },

    clearCacheAll: function() {
        self.caches.keys().then(function (keyList) {
          return Promise.all(keyList.map(function (key, i) {
              return caches.delete(keyList[i])
          }))
        })
    }

}.init(self);




