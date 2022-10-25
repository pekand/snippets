<?php

class uidCommand {

	function uid($length) {
	    $seed = random_int(PHP_INT_MIN, PHP_INT_MAX);
	    mt_srand($seed); 
	    $out = '';
	    $ch = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    for($i=0;$i<$length;$i++) {
	        $out  .= $ch[mt_rand(0,strlen($ch)-1)];
	    }        

	    return $out;
	}

	function check($cmd) {
		$cmd_random = preg_match("/uid/", $cmd, $m); 	
		if($cmd_random){
			return true;
		}

		return false;
	}

	function execute() {
		echo $this->uid(16);
	}
}
