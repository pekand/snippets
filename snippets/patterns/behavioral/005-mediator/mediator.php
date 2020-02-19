<?php

/*
    Separate comunication between components (1-n) to separated mediator object.
    No direct communication between object only through mediator.

    Annalogy to airport control tower. Pilots dont talk to each other who lands.

    Separate comunication between two objects to separate class. (event repository for objects)
    After event occur in one object, object notify mediator and mediator do action in other object.
*/

interface Mediator
{
    public function landingNotification(object $sender): void;
    public function goToRunwayNotification(object $sender): void;
}

class MediatorComponent
{
    protected $mediator;

    public function __construct(Mediator $mediator = null)
    {
        $this->mediator = $mediator;
    }

    public function setMediator(Mediator $mediator): void
    {
        $this->mediator = $mediator;
    }
}


class Plane1 extends MediatorComponent
{
    private $powerOn = false;

    public function holdOn(): void
    {
        echo "Plane1 hold\n";
    }

    public function allow(): void
    {
        echo "Plane1 allow\n";
    }

    public function landing(): void
    {
        echo "component1 landing\n";
        $this->mediator->landingNotification($this);
    }

    public function goToRunway(): void
    {
        echo "component1 goToRunway\n";
        $this->mediator->goToRunwayNotification($this);
    }
}

class Plane2 extends MediatorComponent
{
    public function holdOn(): void
    {
        echo "Plane2 hold\n";
    }

    public function allow(): void
    {
        echo "Plane2 allow\n";
    }

    public function landing(): void
    {
        echo "component2 landing\n";
        $this->mediator->landingNotification($this);
    }

    public function goToRunway(): void
    {
        echo "component2 goToRunway\n";
        $this->mediator->goToRunwayNotification($this);
    }
}


class AirplaneTower implements Mediator
{
    private $plane1;
    private $plane2;

    public function __construct(Plane1 $p1, Plane2 $p2)
    {
        $this->plane1 = $p1;
        $this->plane1->setMediator($this); // set mediator for component

        $this->plane2 = $p2;
        $this->plane2->setMediator($this); // set mediator for component
    }

    public function landingNotification($sender): void // event 1
    {        
        echo "Mediator landing Notification occure\n";
        $this->plane1->holdOn(); // comunicate with components after event is triggered 
        $this->plane2->holdOn();

        $sender->allow();
    }

    public function goToRunwayNotification($sender): void // event 2
    {
        echo "Mediator goToRunway Notification occure\n";
        $this->plane1->holdOn(); // comunicate with components after event is triggered 
        $this->plane2->holdOn();

        $sender->allow();
    }
}

$p1 = new Plane1;
$p2 = new Plane2;
$mediator = new AirplaneTower($p1, $p2); // set mediator for component by constructor (affect c1 and c2)


$p1->landing();  // action 
$p2->goToRunway();