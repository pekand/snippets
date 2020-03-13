<?php

namespace App\Lib\Session;

use Illuminate\Container\Container;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Http\Request;
use Illuminate\Session\DatabaseSessionHandler;
use Illuminate\Support\Facades\Log;

class CustomSessionHandler implements \SessionHandlerInterface
{
    private $sessionHandler = null;

    public function __construct(ConnectionInterface $connection, $table, $minutes, Container $container = null, Request $request)
    {
        $this->sessionHandler = new DatabaseSessionHandler($connection, $table, $minutes, $container);
        $this->request = $request;
    }

    public function open($savePath, $sessionName) {
        return $this->sessionHandler->open($savePath, $sessionName);
    }

    public function close() {
        return $this->sessionHandler->close();
    }

    public function read($sessionId) {
        Log::channel('session')->info("Session read", []);
        return $this->sessionHandler->read($sessionId);
    }

    public function write($sessionId, $data) {
        Log::channel('session')->info("Session write", [
            'uid' => config('requestUid', null),
            'session_id' => \Illuminate\Support\Facades\Session::getId(),
            'session' => $this->request->session()->all(),
        ]);

        return $this->sessionHandler->write($sessionId, $data);
    }

    public function destroy($sessionId) {
        return $this->sessionHandler->destroy($sessionId);
    }

    public function gc($lifetime) {
        $this->sessionHandler->gc($lifetime);
    }
}
