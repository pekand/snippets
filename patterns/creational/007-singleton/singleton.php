<?php

class Singleton {

  private static $instance = null;
  
  private function __construct() // constructor is private instance can be made only with getInstance
  {

  }
 
  public static function getInstance()
  {
    if (self::$instance == null)
    {
      self::$instance = new Singleton();
    }
 
    return self::$instance;
  }
}
 
 
$object1 = Singleton::getInstance(); 
$object2 = Singleton::getInstance(); // get one instance of object
