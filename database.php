<?php
	$sqli = new Msqli('localhost', 'wustlinst', 'wustl_pass', 'newssite');

	if ($sqli->connect_errno){
		printf("Connection Failed: $s\n", $sqli->connect_errno);
		exit;
	}
?>