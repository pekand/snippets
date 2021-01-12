<?php

class Connection {

    private $options = [];

    public function __construct($options) {
        $this->options = $options;
    }

    private function call($method = 'GET', $url = '', $getParams = [], $postParams = [], $data = [], $headers = [], $cookies = []) {
       
        $result = [
            'status' => null,
            'data' => null,
            'headers' => null,
        ];

        $ch = curl_init();

        if (!empty($getParams)) {
            $url .= '?' . http_build_query($getParams);
        }

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);


        if(isset($this->options['timeout'])) {
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->options['timeout']);
        }

        if(isset($this->options['bsaicAuth']) && $this->options['bsaicAuth'] === true && isset($this->options['username']) && isset($this->options['password'])) {
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, $this->options['username'].':'.$this->options['password']);
        }
        
        if(isset($this->options['skipSSL']) && $this->options['skipSSL'] === true) {
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }

        if(isset($this->options['certificate'])) {
            curl_setopt($ch, CURLOPT_CAINFO, realpath($this->options['certificate']));
            curl_setopt($ch, CURLOPT_CAPATH, '.');
        }

        if(isset($this->options['cookieFile'])) {
            curl_setopt($ch, CURLOPT_COOKIEJAR, $this->options['cookieFile']);
            curl_setopt($ch, CURLOPT_COOKIEFILE, $this->options['cookieFile']);
        }

        if (!empty($postParams)) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postParams));
        }

        if (!empty($headers) || !empty($data) || !empty($cookies)) { 

            if(!empty($data)) {
                $headers [] = 'Content-Type:application/json';
            }

            if(!empty($cookies)) {
                $headers [] = 'Cookie: '.http_build_query($postParams);
            }

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        if(!empty($data)) {
            $payload = json_encode($data);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        }       

        $response = curl_exec($ch);

        $error = false;
        $errno = 0;
        if (curl_errno($ch)) {
            $error = curl_error($ch);
            $errno = curl_errno($ch);
        }

        if (is_resource($ch)) {
            curl_close($ch);
        }

        if ($error) {
            throw new \Exception($error, $errno);
        }

        $responseData = '';
        $responseHeaders = '';

        list($responseHeaders, $responseData) = explode("\r\n\r\n", $response, 2);

        $responseHeaders = preg_split('/\r\n|\r|\n/', $responseHeaders);

        $result['headers'] = $responseHeaders;

        $jsonResponse = @json_decode($responseData, true);

        if(json_last_error() == JSON_ERROR_NONE) {
            $result['data'] = $jsonResponse;
        } else {
            $result['data'] = $responseData;
        }

        $result['status'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        

        return $result;
    }

    public function getCertificate($url) {
        $orignal_parse = parse_url($url, PHP_URL_HOST);

        $get = stream_context_create(array("ssl" => array(
            "capture_peer_cert" => true,
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        )));

        $read = stream_socket_client("ssl://".$orignal_parse.":443", $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $get);
        $cert = stream_context_get_params($read);
        $certinfo = openssl_x509_parse($cert['options']['ssl']['peer_certificate']);

        openssl_x509_export($cert["options"]["ssl"]["peer_certificate"], $cert);

        return $cert;
    }

    public function get($url = '', $getParams = [], $postParams = [], $data = [], $headers = [], $cookies = []) {        
        return $this->call('GET', $url, $getParams, $postParams, $data, $headers, $cookies);
    }

    public function post($url = '', $getParams = [], $postParams = [], $data = [], $headers = [], $cookies = []) {         
        return $this->call('POST', $url, $getParams, $postParams, $data, $headers, $cookies);
    }

    public function put($url = '', $getParams = [], $postParams = [], $data = [], $headers = [], $cookies = []) {        
        return $this->call('PUT', $url, $getParams, $postParams, $data, $headers, $cookies);
    }

    public function patch($url = '', $getParams = [], $postParams = [], $data = [], $headers = [], $cookies = []) {        
        return $this->call('PATCH', $url, $getParams, $postParams, $data, $headers, $cookies);
    }

    public function delete($url = '', $getParams = [], $postParams = [], $data = [], $headers = [], $cookies = []) {        
        return $this->call('DELETE', $url, $getParams, $postParams, $data, $headers, $cookies);
    }
}


