<?php
	session_start();
	require 'database.php';

	// check that user is logged in, comment id exists and belongs to user
	if (!isset($_SESSION['user']) || !isset($_POST['comment'])){
		header("Location: index.php");
		exit;
	}

	$comment = $_POST['comment'];
	$id = $_POST['id'];
	$user = $_SESSION['user'];
	$storyid = $_POST['story'];

	$stmt = $sqli->prepare('update comments set comment = ? where comments.id = ?');
	$stmt->bind_param('ss', $comment, $id);
	$stmt->execute();

	$stmt->close();

	$link = 'view.php?id='.$storyid;

	header("Location: $link");
	exit;
?>
