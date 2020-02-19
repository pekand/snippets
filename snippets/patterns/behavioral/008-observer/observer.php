<?php

/*
    Atatach observer to some object. If same event occure all attachet observers get notifications about it. (event objects)
*/

class User
{
    private $email;
    private $observers = [];

    public function __construct()
    {
        
    }

    public function attach($observer)
    {
        $this->observers[] = $observer;
    }

    public function detach($observer)
    {
        $this->observers->detach($observer);
        unset($this->observers[array_search($observer, $this->observers)]);
    }

    public function changeEmail(string $email)
    {
        $this->email = $email;
        $this->notify();
    }

    public function notify()
    {
        foreach ($this->observers as $observer) { // notify observers
            $observer->update($this);
        }
    }
}


class UserObserver
{
    private $changedUsers = [];


    public function update($subject)
    {
        $this->changedUsers[] = clone $subject;
    }


    public function getChangedUsers(): array
    {
        return $this->changedUsers;
    }
}


$observer = new UserObserver();

$user = new User();
$user->attach($observer);
$user->changeEmail('some@email.com');

echo "Changed users\n";
var_dump($observer->getChangedUsers());
