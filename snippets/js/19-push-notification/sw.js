var worker = {
    init: function (scope){
        this.scope = scope;

        this.CACHE_NAME = 'ofline_v2';
        
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
        this.scope.addEventListener('install', this.install.bind(this));
        this.scope.addEventListener('fetch', this.fetch.bind(this));
        this.scope.addEventListener('activate', this.activate.bind(this));
    },

    install: function(event) {
        console.log('ServiceWorker Install');
        var URLS = this.URLS;
        console.log(URLS);
        event.waitUntil(
        caches.open('offline').then((cache) => {
          return cache.addAll(URLS);
        })
      );
    },

    activate: function(event) {
        console.log('ServiceWorker Activate');
        var CACHE_NAME = this.CACHE_NAME;
        console.log(CACHE_NAME);


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

    fetch: function(event) {
        console.log('ServiceWorker Fetch');
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
     }
}

worker.init(self);
