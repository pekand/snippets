<?php

namespace App\Lib\Session;

use Illuminate\Container\Container;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Http\Request;
use Illuminate\Session\DatabaseSessionHandler;
use Illuminate\Support\Facades\Log;
use SessionHandlerInterface;

class CustomSessionHandler extends DatabaseSessionHandler implements SessionHandlerInterface
{
    private $sessionHandler = null;

    public function __construct(ConnectionInterface $connection, $table, $minutes, Container $container = null, Request $request)
    {
        parent::__construct($connection, $table, $minutes, $container);
        $this->request = $request;
    }

    public function read($sessionId) {
        Log::channel('session')->info("Session read", []);
        return parent::read($sessionId);
    }

    public function write($sessionId, $data) {
        Log::channel('session')->info("Session write", [
            'uid' => config('requestUid', null),
            'session_id' => \Illuminate\Support\Facades\Session::getId(),
            'session' => $this->request->session()->all(),
        ]);

        return parent::write($sessionId, $data);
    }
}
