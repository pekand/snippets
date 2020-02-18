var storage = {
   
    init: function() {

        this.bindEvents();

        this.uid = this.getUid();
        this.lastMessage = null;

        this.tabs = [];

        console.log(this.uid);

        this.sendMesageToAll('ping');

        this.mainTab = localStorage.getItem('mainTab');
        if(!this.mainTab){
            this.mainTab = this.uid;
            localStorage.setItem('mainTab', this.mainTab);
            console.log("became main tab");
        }

        return this;
    },

    bindEvents: function() {
        window.addEventListener("storage", this.storageChange.bind(this), false);
        window.addEventListener("beforeunload", this.beforeunload.bind(this), false);
    },    
   
    beforeunload: function() {
        if(this.uid == this.mainTab){
            if(this.tabs.length > 0){
                localStorage.setItem('mainTab', this.tabs[0]);
            } else {
                localStorage.removeItem('mainTab');
            }
        }
        this.sendMesageToAll('clossing');
    },

    storageChange: function() {

        var mainTab = localStorage.getItem('mainTab');        
        if(this.mainTab != mainTab){
            this.mainTab = mainTab;
            if(mainTab == this.uid){
                console.log("became main tab");
            }            
        }

        var message = localStorage.getItem('message');        
        if(message !== null && this.lastMessage != message){
           var data = JSON.parse(message);  
           this.lastMessage = message;
           console.log(data);   

           if(data.from != this.uid && data.message == 'ping'){
                if(!this.tabs.includes(data.from)){
                    this.tabs.push(data.from);
                }

                this.sendMesageTo("pong", data.from);
           }               

           if(data.from != this.uid && data.message == 'clossing'){
                var newTabs = [];
                for(tab of this.tabs){
                    if(tab != data.from){
                        newTabs.push(tab);
                    }
                }
                this.tabs = newTabs

                console.log(this.tabs);
           } 
        }

        var keyStartWith = 'to-'+this.uid;
        for (var key in localStorage){
           if (key.startsWith(keyStartWith)) {
               var data = JSON.parse(localStorage.getItem(key));                      
               console.log(data); 

               if(data.message == 'pong' ) {
                    if(!this.tabs.includes(data.from)){
                        this.tabs.push(data.from);
                    }
               }     

               localStorage.removeItem(key);    
           }
        }
    },

    getUid: function(){
        return Math.random().toString(36).substr(2, 5)+Math.random().toString(36).substr(2, 5);
    },

    sendMesageToAll: function (message){
        
        var data = {
            time: (new Date()).getTime(),
            random: Math.random(),
            from: this.uid,
            message: message
        }

        localStorage.setItem('message', JSON.stringify(data));
    },

    sendMesageTo: function (message, to){
        
        var data = {
            time: (new Date()).getTime(),
            random: Math.random(),
            from: this.uid,
            to: to,
            message: message
        }

        localStorage.setItem('to-'+to+this.getUid(), JSON.stringify(data));
    },
}
