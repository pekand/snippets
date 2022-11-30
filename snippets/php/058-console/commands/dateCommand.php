<?php

class dateCommand {
	function check($cmd) {
		$cmd_date = preg_match("/date/", $cmd, $m); 	
		if($cmd_date){
			return true;
		}

		return false;
	}

	function execute() {
		echo date("Y-m-d H:i:s");
	}
}
