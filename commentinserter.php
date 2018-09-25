<?php
	session_start();
	require 'database.php';

	if (!isset($_SESSION['user']) || !isset($_POST['comment'])){
		header("Location: index.php");
		exit;
	}

	$comment = $_POST['comment'];
	$owner = $_SESSION['user'];
	$id = $_POST['id'];

	$stmt = $sqli->prepare('insert into comments (story, owner, comment) values (?,?,?)');
	$stmt->bind_param('sss', $id, $owner, $comment);
	$stmt->execute();
	$link = 'view.php?id='.$id;
	header("Location: $link");
	exit;
?>