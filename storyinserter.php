<?php
	session_start();
	require 'database.php';

	if (!isset($_SESSION['user']) || !isset($_POST['title'])){
		header("Location: index.php");
		exit;
	}

	$story = $_POST['story'];
	$title = $_POST['title'];

	$user = $_SESSION['user'];

	$stmt = $sqli->prepare('insert into stories (owner, stories, title) values ( ?, ?, ?)');
	$stmt->bind_param('sss', $user, $story, $title);
	$stmt->execute();

	
	$stmt->close();

	$quer = $sqli->prepare('select id from stories where title = ?');
	$quer->bind_param('s', $title);
	$quer->execute();
	$quer->bind_result($id);

	$quer->fetch();
	$link = 'view.php?id='.$id;
	$quer->close();

	$quer2 = $sqli->prepare('update stories set link = ? where id = ?');
	$quer2->bind_param('ss', $link, $id);
	$quer2->execute();

	header("Location: index.php");
	exit;
?>