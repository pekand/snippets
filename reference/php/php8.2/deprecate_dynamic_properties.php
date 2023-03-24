<?php

error_reporting(E_ALL);

class User
{
    public $name;
}


$user = new User();
//Deprecated: Creation of dynamic property User::$last_name is deprecated
$user->last_name = 'Doe'; // Deprecated notice

$user = new stdClass();
$user->last_name = 'Doe'; // Still allowed