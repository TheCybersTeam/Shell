<?php
	
	reverse("youtube.com");

	function reverse($host){
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, "http://domains.yougetsignal.com/domains.php");
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "remoteAddress=$host");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$res = curl_exec($ch);
	curl_close($ch);

	$json = json_decode($res);
	print_r($json);
	}
?>
