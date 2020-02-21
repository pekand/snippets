<?php

/*
    Object can store current state to memento object by method (no externnal function need access to data of object)
    Object can restore own state from memto object
*/

class TicketMemento
{
    private String $name;
    private String $state;

    public function __construct(String $name, String $state)
    {
        $this->name = $name;
        $this->state = $state;
    }

    public function getName(): String
    {
        return $this->name;
    }

    public function getState(): String
    {
        return $this->state;
    }
}

class Ticket
{
    const STATE_CREATED = 'created';
    const STATE_OPENED = 'opened';
    const STATE_ASSIGNED = 'assigned';
    const STATE_CLOSED = 'closed';

    private String $name;
    private String $state;

    public function __construct(String $name)
    {
        $this->name = $name;
        $this->state = Ticket::STATE_CREATED;
    }

    public function setName(String $name)
    {
        $this->name = $name;
    }

    public function getName(): String
    {
        return $this->name;
    }

    public function open()
    {
        $this->state = Ticket::STATE_OPENED;
    }

    public function assign()
    {
        $this->state = Ticket::STATE_ASSIGNED;
    }

    public function close()
    {
        $this->state = Ticket::STATE_CLOSED;
    }

    public function saveToMemento(): TicketMemento // Save object  state no xternal function is needed for access to data
    {
        return new TicketMemento($this->name, $this->state);
    }

    public function restoreFromMemento(TicketMemento $memento) // object  restore state from memento (undo via rollback)
    {
        $this->name = $memento->getName();
        $this->state = $memento->getState();
    }

    public function getState(): String
    {
        return $this->state;
    }
}


$ticket = new Ticket("Ticket A");
$ticket->open();

echo $ticket->getName()." ".$ticket->getState()."\n";

$memento = $ticket->saveToMemento();

$ticket->setName("Ticket B");
$ticket->assign();

echo $ticket->getName()." ".$ticket->getState()."\n";

$ticket->restoreFromMemento($memento);

echo $ticket->getName()." ".$ticket->getState()."\n";
