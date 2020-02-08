<?php

namespace Logic;

// business logic
class ServerLogic
{
    static $clients = [];
    static $operators = [];
 
    static $chatsStorage = null;
    
    public static function getChatStorage()
    {
        if (self::$chatsStorage == null){
            self::$chatsStorage = new ChatsStorage();
        }
        
        return self::$chatsStorage;
    }
    
    public static function isOperator($clientUid)
    {
        return isset(self::$operators[$clientUid]);
    }
    
    public static function addOperator($clientUid)
    {
        self::$operators[$clientUid] = [];
        self::removeClient($clientUid);
    }
    
    public static function removeOperator($clientUid)
    {
        unset(self::$operators[$clientUid]);
        self::addClient($clientUid);
    }
    
    public static function addClient($clientUid)
    {
        self::$clients[$clientUid] = [];
    }
    
    public static function removeClient($clientUid)
    {
        unset(self::$clients[$clientUid]);
    }
    
    public static function getClients()
    {
       return self::$clients;
    }
    
    public static function getOperators()
    {
       return self::$operators;
    }
}