<?php
	session_start();
	require 'database.php';

	if (!isset($_SESSION['user']) || !isset($_GET['id'])){
		header("Location: index.php");
		exit;
	}
	$id = $_GET['id'];
	
	$stmt = $sqli->prepare('select story from comments where id = ? and owner = ?');
	$stmt->bind_param('ds', $id, $_SESSION['user']);
	$stmt->execute();
	$stmt->bind_result($usr);
	if (!$stmt->fetch()){
		header("Location: index.php");
		exit;
	}
	$stmt->close();
	

	$del = $sqli->prepare('delete from comments where id = ?');
	$del->bind_param('d', $id);
	$del->execute();
	$del->close();
	$link = 'view.php?id='.$usr;
	header("Location: $link");
	exit;
?>