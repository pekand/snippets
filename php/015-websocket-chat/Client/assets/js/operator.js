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
        this.connection.sendMesage({operation:'getUid'});
        this.connection.sendMesage({operation:'login', token: 'password'});
    },
    
    messageArrive: function(data) {
        if(data.operation == "uid"){
            this.clientUid = data.uid;
        }
        
        if(data.operation == "loginSuccess"){
            this.logged = true;
            this.connection.sendMesage({operation:'getClients'});
        }
        
        if(data.operation == "clients") {
            var clients = data.clients;
            
            for (var client of clients) {
                this.createChatbox(client);
            }
        }
        
        if(data.operation == "messageFromClient"){            
            this.chats[data.from].addOperatorMesage(data.message);
        }
        
        if(data.operation == "newClient"){            
            this.createChatbox(data.client);
        }
        
        if(data.operation == "clientDisconected"){            
            this.removeChatbox(data.client);
        }
        
    },
    
    createChatbox: function(client){
        this.chatsContainer.appendChild(this.el('<div id="'+client+'" class="chatbox__wrapper"></div>'))
        this.chats[client] = chatbox(client);
        this.chats[client].setTitle(client);
        this.chats[client].addSendMessageListener(this.sendMessageClick.bind(this))
    },
       
    sendMessageClick: function(message, chatbox) {
        
        var data = {
            operation: "sendMessage",
            to: chatbox.chatbox.id,
            message: message
        }

        this.connection.sendMesage(data);
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
