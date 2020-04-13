
// chrome://inspect/#workers

var client = {
    init: function(url){
        this.url = url;
        this.bindEvents();

        // https://web-push-codelab.glitch.me/
        this.publicKey = 'BLnS3BU0062aC8vRIgtfyjtK_axiJppWFda1HtdeNd5ztzTDiWwCAO97DbjjIgWwWpg90l1bP1URlRwpYpuIhrg';
        this.privateKey = 'Ez9CZ4ouYQJPG8GhBe5ZuYFJmzVrMr7hnXos_57Q2SY';
        this.isSubscribed = null; 
    },

    bindEvents: function(){
        document.getElementById('register').addEventListener('click', this.register.bind(this));
        document.getElementById('unregister').addEventListener('click', this.unregister.bind(this));
        document.getElementById('clearcache').addEventListener('click', this.clearcache.bind(this));
    },

    register: function() {
        if (!('serviceWorker' in navigator) || !('PushManager' in window)) {
            console.log('ServiceWorkers are not supported in this browser');
            return;
        }

        navigator.serviceWorker.register(this.url).then(function(registration) {
          console.log('ServiceWorker registration successful with scope: ', registration.scope);

          this.getSubscription(registration);

        }.bind(this), function(err) {
          console.log('ServiceWorker registration failed: ', err);
        });
    }, 

    getSubscription: function(registration) {
        registration.pushManager.getSubscription()
          .then(function(subscription) {
            this.isSubscribed = !(subscription === null);

            if (this.isSubscribed) {
              console.log('User IS subscribed.');
            } else {
              console.log('User is NOT subscribed.');
            }

          }.bind(this));
    },

    unregister: function() {
        navigator.serviceWorker.getRegistrations().then(
            function(registrations) {
                for(let registration of registrations) {  
                    console.log('ServiceWorker unregistred: '+registration.scope);
                    registration.unregister();
                }
            }
        );
    },

    clearcache: function() {
        
    }
};
