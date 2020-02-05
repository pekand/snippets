var app = {
    init: function() {
        this.connection  = websocket.init();
       
        this.bindComponents();
        this.bindEvents();

        return this;
    },

    bindComponents: function(){
         this.chatbox = chatbox("chatbox");
    },

    bindEvents: function() {
        this.connection.addAfterConnectionListener(this.connectionCreated.bind(this));
        this.connection.addMessageListener(this.messageArrive.bind(this));
        this.chatbox.addSendMessageListener(this.sendMessageClick.bind(this));
    },

    connectionCreated: function() {       
        this.connection.sendMesage({operation:'getUid'});
    },
    
    messageArrive: function(data) {
        if(data.operation == "uid"){
            this.chatbox.chatboxTitle.innerHTML = data.uid;
        }
        
        if(data.operation == "message" || data.operation == "message"){
           this.chatbox.addOperatorMesage(data.message);
        }
    },
       
    sendMessageClick: function(message) {
    	
        var data = {
            operation: "sendMessageToOperator",
            message: message
        }

        this.connection.sendMesage(data);
    },

    
}.init();
