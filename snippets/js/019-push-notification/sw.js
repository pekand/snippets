var swWorker = {
    init: function (scope){
        this.version = '3';
        this.scope = scope;
        this.CACHE_NAME = 'ofline_v3';
        this.channel = new BroadcastChannel('swListener');
        
        this.URLS = [
            './', // cache index.html (represent requested url not file)
            './index.html',
            './favicon.ico',
            './styles.css',
            './client.js',
            './sw.js',
            './script.js',
            './message.png',
            './rubiks.jpg',
        ]

        this.bindEvents();
    },

    bindEvents: function(){
        this.scope.addEventListener('message', this.messageEvent.bind(this));
        this.scope.addEventListener('install', this.installEvent.bind(this));
        this.scope.addEventListener('activate', this.activateEvent.bind(this));

        this.scope.addEventListener('fetch', this.fetchEvent.bind(this));
        this.scope.addEventListener('sync', this.syncEvent.bind(this));
        this.scope.addEventListener('push', this.pushEvent.bind(this));
    },

    messageEvent: function(event) {
        console.log('SericeWorker Message From Client: ' + event.data);

        if(event.data.action === 'buildCache') {
            this.buildCache();
        }

        if(event.data.action === 'clearCacheAll') {
            this.clearCacheAll();
        }

        if(event.data === 'version') {
            this.channel.postMessage({action: 'version', version:this.version});
            /*clients.get(event.clientId).then(function (client) {
                client.postMessage({
                  action: "version",
                  version: this.version
                });
            }.bind(this));*/
        }
    },

    installEvent: function(event) {
        console.log('ServiceWorker Install');
        
        event.waitUntil(
            this.buildCache()
        );
    },

    activateEvent: function(event) {
        console.log('ServiceWorker Activate');
        var CACHE_NAME = this.CACHE_NAME;

        console.log('ServiceWorker Search for Old Cache');
        event.waitUntil(
            caches.keys().then(function (keyList) {
              return Promise.all(keyList.map(function (key, i) {
                if (key !== CACHE_NAME) {
                    console.log('ServiceWorker Clean Cache ' + key);
                    return caches.delete(keyList[i])
                }
              }))
            })
        )
    },

    fetchEvent: function(event) {
        console.log('ServiceWorker Fetch Event');
        console.log(event.request);
        event.respondWith(
            caches.match(event.request).then(function (request) {
                return request || fetch(event.request)
            })

            // response with 
            /*new Response('<p>Page Is Offline</p>', {
              headers: { 'Content-Type': 'text/html' }
            })*/
        );
    },

    syncEvent: function(event) {
        console.log('ServiceWorker Sync Event');
    },

    pushEvent: function(event) {
        console.log('ServiceWorker Push Event');
    },

    notifyMe: function(title, callback = null, options = {}) {
        if (!("Notification" in window)) {
            return;
        }

        if (Notification.permission === "denied" ) {
            return;
        }

        if (Notification.permission !== "denied" && Notification.permission !== "granted") {
            Notification.requestPermission().then(function(permission) {
                notifyMe(title, options);
            });
            return;
        }

        var notification = new Notification(title, options);
        notification.onclick = callback;
    },
    
    showNotification: function(title, callback = null, options = {}) {
        this.notifyMe('New Message', function(e) {
                console.log("Notification click");
                console.log(e.target.tag);
                console.log(e.target.data);
            }, {
            body: 'Description',
            tag: 'notification-'+(new Date().getTime()), // notification id (The same notification will not be displayed multiple times)
            icon:'message.png',
            badge:'message.png',
            image: 'rubiks.jpg',
            data: {action:'actionName'}, 
            vibrate: [200, 100, 200],
            renotify: false, // renotify if multiple notification appear in some time
            requireInteraction: false, // show until not clicked
            silent: false, // no sound and vibration
        });
    },

    buildCache : function() {
        var URLS = this.URLS;
        console.log(URLS);

        console.log('ServiceWorker create cache: ' + this.CACHE_NAME);

        return caches.open(this.CACHE_NAME).then((cache) => {
          return cache.addAll(URLS);
        });
    },

    clearCacheAll: function() {
        caches.keys().then(function (keyList) {
          return Promise.all(keyList.map(function (key, i) {
              console.log('Clean Cache ' + key);
              return caches.delete(keyList[i])
          }))
        })
    }
}.init(self);
