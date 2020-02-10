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
        this.connection.sendMessage({action:'getUid'});
        this.connection.sendMessage({action:'openChat', chatUid:this.chatUid});
    },
    
    messageArrive: function(data) {       
        if(data.action == "operatorAddMessageToChat"){
           this.chatbox.addMessageTarget(data.message);
        }
        
        if(data.action == "clientAddMessageToChat"){
           this.chatbox.addMessageSource(data.message);
        }
        
        if(data.action == "chatUid" && data.chatUid != 'null' && data.chatUid != '' && data.chatUid != null) {
           this.chatUid = data.chatUid;
           this.chatbox.setTitle(data.chatUid);
           localStorage.setItem('chatUid', data.chatUid);
           this.connection.sendMessage({action:'getChatHistory', chatUid:this.chatUid});
        }
        
        if(data.action == "chatHistory"){
           this.chatbox.clearMesages();

           for(var key in data.chatHistory.messages){
             var message = data.chatHistory.messages[key];
             
             if (message.type=='operator') {
               this.chatbox.addMessageTarget(message.message);
             } 
             
             if (message.type=='client') {
               this.chatbox.addMessageSource(message.message);
             }
           }
           
           this.chatbox.show();
        }
        
        if(data.action == "operatorsDisconected") {
           this.chatbox.addMessageTarget("Operator go offline");
        }
        
        if(data.action == "operatorConnected") {
           this.chatbox.addMessageTarget("Operator is online");
        }
    },
       
    sendMessageClick: function(message) {
    	
        var data = {
            action: "addClientMessageToChat",
            chatUid: this.chatUid,
            message: message
        }

        this.connection.sendMessage(data);
    },

    
}.init();
