var app = { 
    init: function() {
        this.chats = [];
        this.logged = false;
        this.clientUid = false;
        this.connection = websocket.init();
       
        this.bindComponents();
        this.bindEvents();

        return this;
    },

    bindComponents: function(){
        this.chatsContainer = document.getElementById('chats');
    },

    bindEvents: function() {
        this.connection.addAfterConnectionListener(this.connectionCreated.bind(this));
        this.connection.addMessageListener(this.messageArrive.bind(this));
    },

    connectionCreated: function() {       
        this.connection.sendMessage({operation:'getUid'});
        this.connection.sendMessage({operation:'login', token: 'password'});
    },
    
    messageArrive: function(data) {
        if(data.operation == "uid"){
            this.clientUid = data.uid;
        }
        
        if(data.operation == "loginSuccess"){
            this.logged = true;
            this.connection.sendMessage({operation:'getAllOpenChats'});
        }
        
        if(data.operation == "allOpenChats") {
            var chats = data.chats;
            
            for (var key in chats) {
                this.createChatbox(chats[key]);
                this.connection.sendMessage({operation:'getChatHistory', chatUid:chats[key]});
            }
        }
        
        if(data.operation == "chatHistory"){
           this.chats[data.chatUid].clearMesages();

           for(var key in data.chatHistory.messages){
             var message = data.chatHistory.messages[key];
             
             if (message.type=='operator') {
               this.chats[data.chatUid].addOperatorMessage(message.message);
             } 
             
             if (message.type=='client') {
               this.chats[data.chatUid].addClientMessage(message.message);
             }
           }
        }
        
        if(data.operation == "clientAddMessageToChat"){
           this.chats[data.chatUid].addClientMessage(data.message);
        }
        
        /*if(data.operation == "messageFromClient"){            
            this.chats[data.from].addOperatorMessage(data.message);
        }*/
        
        /*if(data.operation == "newClient"){            
            this.createChatbox(data.client);
        }*/
        
        /*if(data.operation == "clientDisconected"){            
            this.removeChatbox(data.client);
        }*/        
    },
    
    createChatbox: function(client){
        this.chatsContainer.appendChild(this.el('<div id="'+client+'" class="chatbox__wrapper"></div>'))
        this.chats[client] = chatbox(client);
        this.chats[client].setTitle(client);
        this.chats[client].addSendMessageListener(this.sendMessageClick.bind(this))
    },
       
    sendMessageClick: function(message, chatbox) {
        
        var data = {
            operation: "addOperatorMessageToChat",
            chatUid: chatbox.chatbox.id,
            message: message
        }

        this.connection.sendMessage(data);
    },
    
    removeChatbox: function(client){
        document.getElementById(client).remove();
        delete this.chats[client];
    },

    el: function(html) {
      var div = document.createElement('div');
      div.innerHTML = html.trim();
      return div.firstChild; 
    }
}.init();
