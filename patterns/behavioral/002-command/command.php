<?php

// store requests as commands - events actions in application
// alow undo command
// send command from invoker to reciver

interface Command
{
    public function execute();
}

interface UndoableCommand extends Command
{
    public function undo();
}

class Command1 implements Command // add text to reciver
{
    private Receiver $reciver;

    public function __construct(Receiver $reciver)
    {
        $this->reciver = $reciver;
    }

    public function execute()
    {
        $this->reciver->write('message');
    }
}

class Command2 implements UndoableCommand // turn on and off aditional information in output
{
    private Receiver $reciver;
    
    public function __construct(Receiver $reciver)
    {
        $this->reciver = $reciver;
    }


    public function execute()
    {
        $this->reciver->enableDate();
    }

    public function undo()
    {
        $this->reciver->disableDate();
    }
}

class Receiver // system witch print information and allow turn on and off aditional information in mesage
{
    private bool $enableDate = false;

    private array $output = [];

    public function write(string $str)
    {
        if ($this->enableDate) {
            $str .= ' [extra text in message]';
        }

        $this->output[] = $str;
    }

    public function getOutput(): string
    {
        return join("\n", $this->output);
    }

    public function enableDate()
    {
        $this->enableDate = true;
    }

    public function disableDate()
    {
        $this->enableDate = false;
    }
}

class Invoker
{
    private Command $command;

    public function setCommand(Command $cmd)
    {
        $this->command = $cmd;
    }

    public function run()
    {
        $this->command->execute();
    }
    
    public function undo()
    {
    	if ($this->command instanceof UndoableCommand) {
        	$this->command->undo();
    	}
    }
}

$invoker = new Invoker(); // represent object witch execute command
$receiver = new Receiver(); // represent system witch interprete commands

$invoker->setCommand(new Command1($receiver)); // add text to reciver
$invoker->run();

echo $receiver->getOutput().PHP_EOL.PHP_EOL;
    
$invoker->setCommand(new Command2($receiver)); // turn on extra message
$invoker->run();

$invoker->setCommand(new Command1($receiver)); // add text to reciver
$invoker->run();

$invoker->setCommand(new Command2($receiver)); // undo extra mesage
$invoker->undo();

$invoker->setCommand(new Command1($receiver)); // add text to reciver
$invoker->run();

echo $receiver->getOutput().PHP_EOL;


