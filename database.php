<?php
	$sqli = new Msqli('localhost', 'wustl_inst', 'wustl_pass', 'newssite');

	if ($sqli->connect_errno){
		printf("Connection Failed: $s\n", $sqli->connect_errno);
		exit;
	}
?>