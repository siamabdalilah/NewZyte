<?php
	session_start();
	require 'database.php';

	if (!isset($_SESSION['user']) || !isset($_GET['id'])){
		header("Location: index.php");
		exit;
	}
	$id = $_GET['id'];
	
	$stmt = $sqli->prepare('select count(*) from stories where id = ? and owner = ?');
	$stmt->bind_param('ds', $id, $_SESSION['user']);
	$stmt->execute();
	$stmt->bind_result($usr);
	$stmt->fetch();
	if (!($usr === 1)){
		header("Location: index.php");
		exit;
	}
	$stmt->close();

	$del = $sqli->prepare('delete from stories where id = ?');
	$del->bind_param('d', $id);
	$del->execute();
	$del->close();

	header("Location: index.php");
	exit;
?>