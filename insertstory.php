<?php
	session_start();

	if (!isset($_SESSION['user'])){
		header("Location: index.php");
		exit;
	}

?>

<!doctype html>

<html lang = 'en'>
<head>
	<title>Add Story</title>
</head>
<body>
	<div>
		<a herf = 'logout.php'> Log Out</a><br>
		<a href = 'index.php'>Go Back to Home Page</a><br><br>

	</div>

	<div>
		<form action = 'storyinserter.php' method = 'post'>
			<label>Add Story Title:</label><br><textarea name = 'title' cols = '150' maxlength="150" autofocus required></textarea><br>
			<label>Story:</label><br><textarea name = 'story' cols = '150' rows = '150' maxlength="50000" required></textarea><br>
			<input type = 'submit'/>

		</form>
	</div>
</body>