var app = {
    init: function() {
        this.connection  = websocket.init();
        this.chatUid = localStorage.getItem('chatUid') || '';
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
        this.connection.sendMessage({operation:'getUid'});
        this.connection.sendMessage({operation:'openChat', chatUid:this.chatUid});
    },
    
    messageArrive: function(data) {       
        if(data.operation == "operatorAddMessageToChat"){
           this.chatbox.addOperatorMessage(data.message);
        }
        
        if(data.operation == "clientAddMessageToChat"){
           this.chatbox.addClientMessage(data.message);
        }
        
        if(data.operation == "chatUid") {
           this.chatUid = data.chatUid;
           this.chatbox.setTitle(this.chatUid);
           localStorage.setItem('chatUid', this.chatUid);
           this.connection.sendMessage({operation:'getChatHistory', chatUid:this.chatUid});
        }
        
        if(data.operation == "chatHistory"){
           this.chatbox.clearMesages();

           for(var key in data.chatHistory.messages){
             var message = data.chatHistory.messages[key];
             
             if (message.type=='operator') {
               this.chatbox.addOperatorMessage(message.message);
             } 
             
             if (message.type=='client') {
               this.chatbox.addClientMessage(message.message);
             }
           }
        }
    },
       
    sendMessageClick: function(message) {
    	
        var data = {
            operation: "addClientMessageToChat",
            chatUid: this.chatUid,
            message: message
        }

        this.connection.sendMessage(data);
    },

    
}.init();
