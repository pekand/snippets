<?php

namespace WebSocketServer;

class WebSocketServerBase {   
    //convert byte array string to binnary representation array "A" -> "01000001"
    protected  function str2bin($s) { 
        $res = "";
        for($i = 0;  $i < strlen($s); $i++) {
            $o = ord($s[$i]);
            for($j = 7;  $j >= 0; $j--) {
                $res .= ($o & (1 << $j)) ? '1' : '0';
            }
        }
        return $res;
    }
    
    //convert int to binnary string representation  65 -> "01000001"
    protected function toBin($d, $pad) { 
        return str_pad(decbin($d), $pad, "0", STR_PAD_LEFT);
    }
    
    // convert binnary representation as string to byte array string "01000001" -> "A"
    function bin2str($s) {  
        $r = "";
        $c = 0;
        $cnt = 1;
        for ($i = 0; $i < strlen($s); $i++) {
            
            $c = ($c + ($s[$i] == "1" ? 1 : 0));
            
            if ($cnt == 8) {
                $r .= chr($c);          
                $c = 0;
                $cnt = 0;
            }
            
            $c = $c << 1;   

            $cnt++;
        }
        return $r;
    }
    
    protected function createConnectHeader($data) {
        preg_match('#Sec-WebSocket-Key: (.*)\r\n#', $data, $matches);
        
        $key = "";
        if (isset($matches[1])) {
            $key = base64_encode(pack(
                'H*',
                sha1($matches[1] . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')
            ));
        }
        
        $headers = "HTTP/1.1 101 Switching Protocols\r\n";
        $headers .= "Upgrade: websocket\r\n";
        $headers .= "Connection: Upgrade\r\n";
        $headers .= "Sec-WebSocket-Version: 13\r\n";
        $headers .= "Sec-WebSocket-Accept: $key\r\n\r\n";
        
        return $headers;
    }
    
    protected function mesage($message, $opcode = 1, $mask = false) {
        
        $len = strlen($message);
        $lenext = "";
        if ($len >= 2**16) {
            $len = 127;
            $lenext = $this->toBin(strlen($message), 8*8);
        } else if ($len > 125) {
            $len = 126;
            $lenext = strlen($message);
            $lenext = $this->toBin(strlen($message), 8*2);
        }
                
        $frame = [
            'fin' => '1',
            'rsv1' => '0',
            'rsv2' => '0',
            'rsv3' => '0',
            'opcode'=> $this->toBin($opcode, 4),
            'mask' => $mask ? '1' : '0',
            'len' => $this->toBin($len, 7),
            'lenext' => $lenext,
        ];
        
        $frameHeader = "";
        foreach ($frame as $v) {
            $frameHeader .= $v;
        }

        if($mask) {
            $maskingkey = openssl_random_pseudo_bytes(4);

            $messageMasked = "";
            for ($i = 0; $i<strlen($m); $i++)
                $messageMasked .= $message[$i] ^ $maskingkey[$i % 4];

            return $this->bin2str($frameHeader).$maskingkey.$messageMasked;
        }
        
        return $this->bin2str($frameHeader).$message;
    }

    // rfc6455 The WebSocket Protocol 
    // https://tools.ietf.org/html/rfc6455
    protected function proccessRequest($lastFrame, &$data)
    {
        // proccess additional data
        if ($lastFrame != null && 
            $lastFrame['lenext'] > 0 && 
            $lastFrame['lenext'] < strlen($lastFrame['payloaddata'])
        ) {
            $frame = $lastFrame;

            $frame['payloaddata'] = "";
            
            $remainingLength = $frame['lenext'] - strlen($frame['payloaddata']);
            $data = substr($data, 0, $remainingLength);
            $data = substr($data, $remainingLength);
            
            if ($frame['mask']) {
                for ($i = 0; $i<strlen($data); $i++)
                    $frame['payloaddata'] .= $data[$i] ^ $frame['maskingkey'][$i % 4];
            } else {
                $frame['payloaddata'] .= $data;
            }

            if($frame['lenext'] == strlen($frame['payloaddata'])) {
                $frame['full'] == true;
            }

            return $frame;
        }

        $frame = [];

        if(strlen($data)<2) { //header is too short
            return null; 
        }
        
        $b1 = $this->str2bin($data[0]);
        $frame['fin'] = $b1[0] == '1';
        $frame['rsv1'] = $b1[1] == '1';
        $frame['rsv2'] = $b1[2] == '1';
        $frame['rsv3'] = $b1[3] == '1';
        $frame['opcode'] = bindec(substr($b1, 4, 4));

        $b2 = $this->str2bin($data[1]);
        $frame['mask'] = $b2[0] == '1';
        $frame['len'] = $frame['mask'] ? ord($data[1]) & 127 : ord($data[1]);

        $frame['lenext'] = 0;
        if ($frame['len']===126) {
            
            if(strlen($data)<4) { // header is too short wait for additional data
                return null; 
            }
        
            $frame['lenext'] = bindec(
                $this->str2bin($data[2]).
                $this->str2bin($data[3])
            );
        } elseif ($frame['len']===127) {
            if(strlen($data)<10) { // header is too short wait for additional data
                return null; 
            }
            
            $frame['lenext'] = bindec(
                $this->str2bin($data[2]).
                $this->str2bin($data[3]).
                $this->str2bin($data[4]).
                $this->str2bin($data[5]).
                $this->str2bin($data[6]).
                $this->str2bin($data[7]).
                $this->str2bin($data[8]).
                $this->str2bin($data[9])
            );
        }

        $frame['payloaddata'] = "";
        if ($frame['mask']) {
            if ($frame['len']===126) {
                if(strlen($data)<8) { // header is too short wait for additional data
                    return null; 
                }
            
                $frame['maskingkey'] = substr($data, 4, 4);
            } elseif ($frame['len']===127) {
                if(strlen($data)<12) { // header is too short wait for additional data
                    return null; 
                }
                
                $frame['maskingkey'] = substr($data, 10, 4);
            } else {
                if(strlen($data)<6) { // header is too short wait for additional data
                    return null; 
                }
                
                $frame['maskingkey'] = substr($data, 2, 4);
            }
        
            if ($frame['len']===126){
                $coded_data = substr($data, 8, $frame['lenext']);
                $data = substr($data, $frame['lenext']);
            } elseif ($frame['len']===127) {
                $coded_data = substr($data, 14, $frame['lenext']);
                $data = substr($data, $frame['lenext']);
            } else {
                $coded_data = substr($data, 6, $frame['len']);
                $data = substr($data, $frame['len']);
            }

            for ($i = 0; $i<strlen($coded_data); $i++) {
                $frame['payloaddata'] .= $coded_data[$i] ^ $frame['maskingkey'][$i % 4];
            }
        }
        else
        {
            if ($frame['len']===126) {
                $frame['payloaddata'] = substr($data, 4, $frame['lenext']);
                $data = substr($data, $frame['lenext']);
            } elseif ($frame['len']===127) {
                $frame['payloaddata'] = substr($data, 10, $frame['lenext']);
                $data = substr($data, $frame['lenext']);
            } else {
                $frame['payloaddata'] = substr($data, 2, $frame['len']);
                $data = substr($data, $frame['len']);
            }
        }

        $frame['full'] = false;
        if($frame['len'] < 126 && $frame['len'] == strlen($frame['payloaddata'])) {
            $frame['full'] = true;
        } else if(($frame['len'] == 126 || $frame['len'] == 127) && $frame['lenext'] == strlen($frame['payloaddata'])) {
            $frame['full'] = true;
        }

        $client['lastframe'] = $frame;

        return $frame;
    }
}
