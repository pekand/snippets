<?php

// Open–closed principle
// functionality witch can be in multiple variations encapsulate to other object and use interface (like dll library cant modified souce code)

/*

bad example: error methon must by modified if I wont add notice type

class Logger
{	
	public function error(string $type, string $message)
	{
		switch ($type) { // break Open–closed principle
			case 'error':
				echo "!!! ".$message.PHP_EOL;
				break;
			
			case 'warining':
				echo "(".$message.")".PHP_EOL;
				break;
		}
	}
}


$log = new Logger();
$log->error("error", "error message");

*/

interface LogMessageInterface {
	public function getMessage(): string;
}

abstract class LogMessage implements LogMessageInterface {
	protected  $message; 
	public function __construct($message) {
		$this->message = $message;
	}
	
	abstract public function getMessage(): string;
}

class ErrorMessage extends LogMessage {
	public function getMessage(): string {
		return "!!! ".$this->message;
	}
}

class WariningMessage extends LogMessage {
	public function getMessage(): string {
		return "(".$this->message.")";
	}
}

class NoticeMessage extends LogMessage {
	public function getMessage(): string {
		return "? ".$this->message;
	}
}

class NewErrorMessage extends LogMessage { // add new error message not by modifiing existing class ErrorMessage but add new class NewErrorMessage (old functionality still remaining in ErrorMessage)
	public function getMessage(): string {
		return "E: ".$this->message;
	}
}

class Logger {	
	public function error(LogMessageInterface $message) 	{
		echo $message->getMessage().PHP_EOL;
	}
}

$log = new Logger();
$log->error(new ErrorMessage("error"));
$log->error(new WariningMessage("warning"));
$log->error(new NoticeMessage("notice"));
$log->error(new NewErrorMessage("new error"));
