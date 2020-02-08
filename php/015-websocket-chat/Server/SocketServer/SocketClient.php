<?php

namespace SocketServer;

class SocketClient {   
    
    private $socket = null;
       
    protected $options = [
        'ip'=> '0.0.0.0', 
        'port' => 8080,
    ];
       
    public function __construct($options = []) {
        
        $this->options = array_merge($this->options, $options);
    }

    public function connect($sendHeader = null, $receiveHeader = null) {
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        
        if(!socket_connect($this->socket, '127.0.0.1', 8080)) {
             $this->socket = null;
        }
        
        
        if (isset($sendHeader) && is_callable($sendHeader)) {
            call_user_func_array($sendHeader, [$this]);
        }
        
        if (false === ($headerFromServer = socket_read($this->socket, 2048, MSG_WAITALL))) {
            echo socket_strerror(socket_last_error($this->socket)) . "\n";
        }  
        
        if (isset($receiveHeader) && is_callable($receiveHeader)) {
            call_user_func_array($receiveHeader, [$this, $headerFromServer]);
        }
        
        socket_set_nonblock($this->socket);

        return $this;
    }
    
    public function close() {
        if ($this->socket == null) {
            return $this;
        }
        
        socket_close($this->socket);
        
        return $this;
    }

    public function sendData($data) {        
        socket_write($this->socket, $data, strlen($data));
    }
    

    public function listen($listener = null) {
  
        if (!$this->socket){
            return;
        }
          
        while(true) {    
            $data = "";
            while ($buf = socket_read($this->socket, 1024)) {                        
                $data .= $buf;
            }

            if(strlen($data)>0) {               
               if (is_callable($listener)) {
                    call_user_func_array($listener, [$data]);
                }
            }

            usleep(50000);
        }    
             
    }
}
