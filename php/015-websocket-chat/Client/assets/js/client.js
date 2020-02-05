function L(message) {console && console.log && console.log(message);}

function el(html) {
  var div = document.createElement('div');
  div.innerHTML = html.trim();
  return div.firstChild; 
}

var websocket = {
    messageListeners:[],
    afterConnectionListeners:[],
    afterDisconnectionListeners:[],
    
    init: function(chatboxId) {
        this.createConnection();
        this.bindEvents();
        return this;
    },
    
    createConnection: function() {
        this.conn = new WebSocket('ws://127.0.0.1:8080');
        this.conn.onopen = this.connectionOpen.bind(this);
        this.conn.onclose = this.connectionClose.bind(this);
        this.conn.onerror = this.connectionError.bind(this);
        this.conn.onmessage = this.getMesage.bind(this);
    },

    connectionOpen: function() {
        L("Connection is open...");
        
        for (var listener of this.afterConnectionListeners) {
            if (listener && typeof(listener) === "function") {
                listener();
            }
        }
    },

    connectionClose: function() {
        L("Connection is closed...");
        
        for (var listener of this.afterDisconnectionListeners) {
            if (listener && typeof(listener) === "function") {
                listener();
            }
        }
    },

    connectionError: function() {
        L('Error: ' + error.message);
    },

    getMesage: function(e) {
        L("Mesage from server:" + e.data);

        var data = JSON.parse(e.data);

        L(data);

        if (data.operation == 'ping') {
            this.sendMesage({ operation: "pong" });
            return;
        }
        
        for (var listener of this.messageListeners) {
            if (listener && typeof(listener) === "function") {
                listener(data);
            }
        }
    },
    
    addMessageListener: function(callback) {
        this.messageListeners.push(callback);
    },
    
    addAfterConnectionListener: function(callback) {
        this.afterConnectionListeners.push(callback);
    },
    
    addAfterDisconnectionListener: function(callback) {
        this.afterDisconnectionListeners.push(callback);
    },
    
    sendMesage: function(data) {
        var message = JSON.stringify(data);
        L("Mesage to server:" + message);

        if (this.conn.readyState !== WebSocket.CLOSED) {
            this.conn.send(message);
            return true;
        }
        
        return false;
    },
    
    bindEvents: function() {
        window.addEventListener("beforeunload", this.windowUnload.bind(this));
        setInterval(this.connectionCheck.bind(this), 1000);
    },
    
    windowUnload: function(e) {
        if (this.conn.readyState !== WebSocket.CLOSED) {
            this.conn.close();
        }
    },
    
    connectionCheck: function() {
        if (this.conn.readyState === WebSocket.CLOSED) {
            this.createConnection();
        }
    },
}

var chatbox = {
    init: function(chatboxId, connection) {
        this.connection  = connection;
        this.bindComponents(chatboxId);
        this.bindEvents();

        return this;
    },

    bindComponents: function(chatboxId){
        this.chatbox = document.getElementById(chatboxId);
        this.chatboxHeader = this.chatbox.getElementsByClassName("chatbox__header")[0];
        this.chatboxTitle = this.chatboxHeader.getElementsByClassName("chatbox__title")[0];
        this.chatboxMessges = this.chatbox.getElementsByClassName("chatbox__messages")[0];
        this.chatboxFooter = this.chatbox.getElementsByClassName("chatbox__footer")[0];
        this.newMesageInput = this.chatboxFooter.getElementsByClassName("chatbox__newmessage")[0];
        this.sendButton = this.chatboxFooter.getElementsByClassName("chatbox__send")[0];
    },

    bindEvents: function() {
        this.connection.addAfterConnectionListener(this.connectionCreated.bind(this));
        this.connection.addMessageListener(this.messageArrive.bind(this));
        this.sendButton.addEventListener("click", this.sendMessageClick.bind(this));
        this.newMesageInput.addEventListener("keyup", this.messageInputKeyUpClick.bind(this));
    },

    connectionCreated: function() {       
        this.connection.sendMesage({operation:'getUid'});
    },
    
    messageArrive: function(data) {
        if(data.operation == "uid"){
            this.chatboxTitle.innerHTML = data.uid;
        }
        
        if(data.operation == "message" || data.operation == "message"){
           this.addOperatorMesage(data.message);
        }
    },
       
    addOperatorMesage: function(message) {
        
         var messageEl = el('<div class="chatbox__message"><div class="chatbox__message__text chatbox__message--bounce">'+message+'</div></div>')
         this.chatboxMessges.appendChild(messageEl);
         this.chatboxMessges.scrollTop = this.chatboxMessges.scrollHeight;
    },
    
    sendMessageClick: function() {
        var message = this.newMesageInput.value.trim();
        
        if (message == ""){
            return;    
        }
        
        var data = {
            operation: "sendMessageToOperator",
            message: message
        }

        this.connection.sendMesage(data);
        this.addClientMessage(message);
        
        this.newMesageInput.value = '';
        this.newMesageInput.focus();
    },
    
    addClientMessage: function(message) {
        var messageEl = el('<div class="chatbox__message"><div class="chatbox__message__text chatbox__message__text--right chatbox__message--bounce">'+message+'</div></div>')        
        this.chatboxMessges.appendChild(messageEl);
        this.chatboxMessges.scrollTop = this.chatboxMessges.scrollHeight;
    },
    
    messageInputKeyUpClick: function(e) {
        e.preventDefault();
        if (e.keyCode === 13) {
            this.sendMessageClick();
        }
    },
   
}.init("chatbox", websocket.init());
