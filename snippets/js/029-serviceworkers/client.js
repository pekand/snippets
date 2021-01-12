var swClient = {

    init: function() {
        this.id = this.getUid(64);
        this.online = false;
        this.updateOnlineStatus();

        this.channel = new BroadcastChannel(this.id);

        if (!('serviceWorker' in navigator)) {
            return this;
        }

        this.bindEvents();
        this.serviceRegister();
        return this;
    },

    getUid: function(length){

        var ch = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        var uid = '';

        if(window.crypto) {
            var n = new Uint32Array(length);
            window.crypto.getRandomValues(n);
            for (var i = 0; i<length; i++) {
                uid += ch[n[i] % ch.length];
            }
        } else {
            for (var i = 0; i<length; i++) {
                uid += ch[Math.floor(Math.random() * ch.length)];
            }
        }

        return uid;
    },

    bindEvents: function() {
        navigator.serviceWorker.ready.then(this.serviceWorkerReady.bind(this));

        this.channel.onmessage = this.recieveBroadcastMessage.bind(this);
        navigator.serviceWorker.addEventListener('message', this.messageEvent.bind(this));

        window.addEventListener('online',  this.updateOnlineStatus.bind(this));
        window.addEventListener('offline', this.updateOnlineStatus.bind(this));

        window.addEventListener('beforeunload', this.beforeunload.bind(this)) 
    },

    beforeunload: function(e) {
        if (!e.defaultPrevented) {
            this.sendBroadcastMessage({action:'unload'});
        }
    },

    serviceRegister: function() {
        navigator.serviceWorker.register('sw.js').then(
            this.afterServiceRegistration.bind(this), 
            this.afterServiceRegistrationError.bind(this)
        );
    },

    updateOnlineStatus: function() { 
        this.online = navigator.onLine;
        document.getElementById('status').innerHTML = this.online ? 'online' : 'offline';
    },

    afterServiceRegistration: function() {

    },

    afterServiceRegistrationError: function(err) {
        console.log('ServiceWorker registration failed: ', err);
    },

    serviceWorkerReady: function(registration){
        this.sendMessageToServiceWorker({action:'init', id: this.id});
    },

    recieveBroadcastMessage: function(event) { // mesage only to specific client
        console.log('Broadcast message from service:', event.data);

        var data = event.data;

        if(event.data.action == 'id') {
            if(this.version != data.version) {
                navigator.serviceWorker.getRegistrations().then(function(registrations) {
                    for(var registration of registrations) {
                        if(this.online) {
                            registration.update();
                        }
                    }
                });
            }

            this.sendBroadcastMessage({action:'ping'});
        }
    },

    sendBroadcastMessage: function(message) {
        console.log('Broadcast message to service:', message);
        this.channel.postMessage(message);
    },

    messageEvent: function (message) {
        console.log('Message to clien:', message);
        var data = event.data;
    },

    sendMessageToServiceWorker: function(message) {
        console.log('Message to service:', message);
        navigator.serviceWorker.getRegistrations().then(function(registrations) {
            for(var registration of registrations) {
                registration.active.postMessage(message);
            }
        });
    }

}.init();
