<?php

/*
	Persistent cURL Share Handles
	Unlike curl_share_init(), handles created by curl_share_init_persistent() will not be destroyed at the end of the PHP request. 
	If a persistent share handle with the same set of share options is found, it will be reused, avoiding the cost of initializing cURL handles each time.
*/

// PHP 8.5
	
$share_handle = curl_share_init_persistent([
	CURL_LOCK_DATA_DNS, // share DNS lookups
	CURL_LOCK_DATA_CONNECT, // share connections 
	//CURL_LOCK_DATA_COOKIE - is not permitted with persistent handles.
]);

// --- First Request ---
$ch1 = curl_init('https://php.net/');
curl_setopt($ch1, CURLOPT_SHARE, $share_handle); // Attach the persistent handle
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
echo "Executing first request...\n";
$result1 = curl_exec($ch1);
$info1 = curl_getinfo($ch1, CURLINFO_PRIMARY_IP); // Get resolved IP
echo "Resolved IP for https://php.net/: " . $info1 . "\n";
curl_close($ch1);

// --- Second Request (within the same PHP process/request lifecycle if possible) ---
// If this were in a separate request in FPM, the DNS data would be reused.
$ch2 = curl_init('https://www.php.net');
curl_setopt($ch2, CURLOPT_SHARE, $share_handle); // Attach the *same* handle
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
echo "\nExecuting second request...\n";
$result2 = curl_exec($ch2);
$info2 = curl_getinfo($ch2, CURLINFO_PRIMARY_IP); // Get resolved IP
echo "Resolved IP for https://www.php.net: " . $info2 . "\n";
curl_close($ch2);

// PHP 8.4
$sh = curl_share_init();
curl_share_setopt($sh, CURLSHOPT_SHARE, CURL_LOCK_DATA_DNS);
curl_share_setopt($sh, CURLSHOPT_SHARE, CURL_LOCK_DATA_CONNECT);

$ch = curl_init('https://php.net/');
curl_setopt($ch, CURLOPT_SHARE, $sh);

curl_exec($ch);
