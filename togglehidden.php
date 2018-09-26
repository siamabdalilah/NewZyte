<?php
	session_start();
	require 'database.php';

	//dont allow if there is not a user logged in or story is not specified
	if (!isset($_SESSION['user']) || !isset($_GET['id'])){
		header("Location: index.php");
		exit;
	}

	//verify that story with given id exists. otherwise abort
	$id = $_GET['id'];
	$stmt = $sqli->prepare('select hidd from stories where id = ? and owner = ?');
	$stmt->bind_param('ss', $id, $_SESSION['user']);
	$stmt->execute();
	$stmt->bind_result($hidd);

	if ($stmt->fetch()){
		$stmt->close();
		$ins = 0;
		if ($hidd == 0){
			$ins == 1;
		}

		$query = $sqli->prepare('update stories set hidd = ? where id = ?');
		echo "$id $ins";
		$query->bind_param('is', $ins, $id);
		$query->execute();
		//header("Location: dashboard.php");
		//exit;

	}
	
	else{
		header("Location: index.php");
		exit;
	}
?>

