<?php
	session_start();
	session_destroy();
	$link = '';
	if (isset($_GET['id'])){
		$link .= 'view.php?id='.$_GET['id'];
	}
	else{
		$link .= 'index.php';
	}
	header("Location: $link");
	exit;
?>