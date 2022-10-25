<?php
class Console {

	function getDirContents($dir, $pattern = null) {
	    $results = [];
	    $files = scandir($dir);

	        foreach($files as $key => $value){
	            if(!is_dir($dir. DIRECTORY_SEPARATOR .$value)){
	            	if($pattern != null && preg_match($pattern, $value, $m)) {
	                	$results[$value] = $dir. DIRECTORY_SEPARATOR .$value;
	            	}
	            } else if($value != '.' && $value != '..' && is_dir($dir. DIRECTORY_SEPARATOR .$value)) {
	                $results[] = $value;
	                getDirContents($dir. DIRECTORY_SEPARATOR .$value);
	            }
	        }
	    return $results;
	}

	function run() {
		$commandsFiles = $this->getDirContents(realpath(dirname(__FILE__)).'\commands', "/.*Command\.php/");

		$commands = [];
		foreach($commandsFiles as $name => $path) {
			require_once($path);
			$className = str_replace(".php", "", $name);
			$commands[] = new $className();
		}

		while(true) {
			$in = readline('$ ');
		 
		 	foreach($commands as $command) {
				if($command->check($in)){
					$command->execute($in);
				}
			}
			  
			if(in_array(trim($in), ['exit','quit','close', 'die'])){
				break;
			}

			echo $in.PHP_EOL; 
		}
	}
}

$console = new Console();
$console->run();

