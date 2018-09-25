<?php
	session_start();
	require 'database.php';

	if (!isset($_SESSION['user']) || !isset($_POST['title'])){
		header("Location: index.php");
		exit;
	}

	$story = $_POST['story'];
	$title = $_POST['title'];
	$id = $_POST['id'];
	$user = $_SESSION['user'];

	$stmt = $sqli->prepare('update stories set stories = ?, title = ? where id = ?');
	$stmt->bind_param('sss', $story, $title, $id);
	$stmt->execute();

	
	$stmt->close();

	header("Location: index.php");
	exit;
?>