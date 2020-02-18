var worker = {
    init: function (space){
        this.connections = 0;
        this.space = space;
        this.ports = [];
        this.bindEvents();
    },

    getUid: function(){
        return Math.random().toString(36).substr(2, 5)+Math.random().toString(36).substr(2, 5);
    },

    bindEvents: function(){
        this.space.addEventListener("connect", this.connect.bind(this), false);
    },

    connect: function(e){
        var uid = this.getUid();
        this.connections++;
        var port = e.ports[0];        
        this.ports[uid] = port;       

        port.addEventListener("message", function(e){
            this.message(e, uid, port);
        }.bind(this), false);

        port.start();
        this.sendAction(port, 'uid', {uid:uid});        
    },

    message: function(e, uid, port){       
        var data = JSON.parse(e.data);
        
        if(data.action === 'ping') {
            console.log('Ping from :'+data.uid)
        }

        if(data.action === 'close') {
            console.log('Close :'+data.uid)
            this.ports[uid] = null;
            port.close();  
            this.connections--;
            
            if(this.connections===0){
                this.close();
            }
        }
    },

    sendMessage: function(port, message) {
        port.postMessage(message);
    },

    sendAction: function(port, action, data) {
        data.action = action;
        this.sendMessage(port, JSON.stringify(data));
    },

    close: function() {
        console.log("finish");
    },
}

worker.init(self);
