
// chrome://inspect/#workers

var client = {
    init: function(url){
        this.uid = null;
        this.worker = new SharedWorker(url);
        this.port = this.worker.port;
        this.port.start();
        this.bindEvents();
    },

    bindEvents: function(){
        this.port.addEventListener("message", this.message.bind(this), false);
        window.addEventListener("beforeunload", this.unload.bind(this), false);
    },

    message: function(e){
        var data = JSON.parse(e.data)
        console.log(data);
        if(data.action === 'uid'){
            this.uid = data.uid;
            console.log("Uid"+this.uid);
            this.sendAction('ping', {uid:this.uid});
        }
    },

    unload: function(e){
        this.sendAction("close", {uid:this.uid})
    },

    sendMessage: function(message) {
        this.port.postMessage(message);
    },

    sendAction: function(action, data) {
        data.action = action;
        this.sendMessage(JSON.stringify(data));
    }
};

	