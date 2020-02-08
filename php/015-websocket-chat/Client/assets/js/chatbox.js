function chatbox(chatboxId){return {
    sendMessageListeners:[],
    
    init: function(chatboxId) {
        this.bindComponents(chatboxId);
        this.bindEvents();

        return this;
    },

    bindComponents: function(chatboxId){
        this.chatbox = document.getElementById(chatboxId);
        
        this.chatbox.appendChild(this.el('<div class="chatbox"><div class="chatbox__header"><div class="chatbox__title">Mesasges</div></div><div  class="chatbox__messages"></div><div class="chatbox__footer"><input class="chatbox__newmessage" type="text" placeholder="Type message..."><button class="chatbox__send">Send</button></div></div>'));
       
        this.chatboxHeader = this.chatbox.getElementsByClassName("chatbox__header")[0];
        this.chatboxTitle = this.chatboxHeader.getElementsByClassName("chatbox__title")[0];
        this.chatboxMessges = this.chatbox.getElementsByClassName("chatbox__messages")[0];
        this.chatboxFooter = this.chatbox.getElementsByClassName("chatbox__footer")[0];
        this.newMesageInput = this.chatboxFooter.getElementsByClassName("chatbox__newmessage")[0];
        this.sendButton = this.chatboxFooter.getElementsByClassName("chatbox__send")[0];
    },

    bindEvents: function() {
        this.sendButton.addEventListener("click", this.sendMessageClick.bind(this));
        this.newMesageInput.addEventListener("keyup", this.messageInputKeyUpClick.bind(this));
    },
       
    addOperatorMessage: function(message) {
         var messageEl = this.el('<div class="chatbox__message"><div class="chatbox__message__text chatbox__message--bounce">'+message+'</div></div>')
         this.chatboxMessges.appendChild(messageEl);
         this.chatboxMessges.scrollTop = this.chatboxMessges.scrollHeight;
    },
    
    sendMessageClick: function() {
        var message = this.newMesageInput.value.trim();
        
        if (message == ""){
            return;    
        }
        
        for (var listener of this.sendMessageListeners) {
            if (listener && typeof(listener) === "function") {
                listener(message, this);
            }
        }
        
        this.addClientMessage(message);
        
        this.newMesageInput.value = '';
        this.newMesageInput.focus();
    },
    
    addClientMessage: function(message) {
        var messageEl = this.el('<div class="chatbox__message"><div class="chatbox__message__text chatbox__message__text--right chatbox__message--bounce">'+message+'</div></div>')        
        this.chatboxMessges.appendChild(messageEl);
        this.chatboxMessges.scrollTop = this.chatboxMessges.scrollHeight;
    },
    
    messageInputKeyUpClick: function(e) {
        e.preventDefault();
        if (e.keyCode === 13) {
            this.sendMessageClick();
        }
    },
    
    addSendMessageListener: function(callback) {
        this.sendMessageListeners.push(callback);
    },
    
    setTitle: function(title) {
        this.chatboxTitle.innerHTML = '';
        this.chatboxTitle.appendChild(document.createTextNode(title));
    },
    
    clearMesages: function(title) {
        this.chatboxMessges.innerHTML = '';
    },
    
    el: function(html) {
      var div = document.createElement('div');
      div.innerHTML = html.trim();
      return div.firstChild; 
    }
}.init(chatboxId)};
