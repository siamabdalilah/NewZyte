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
	<div class = 'top'>
			<div class = 'title'>
				NewZyte
			</div>

			<div class = 'rightside'>
				<?php
					
					echo "Welcome, ";
					echo htmlspecialchars($_SESSION['user']);

					echo "&nbsp <a href = 'logout.php' class = 'button'> Log Out</a>&nbsp";
					echo "<a href = 'index.php' class = 'button'>Home</a>";
				?>
			</div>
		</div>

	<div class = 'middle'>
		<form action = 'storyinserter.php' method = 'post'>
			<label class = 'largetext'>Add Story Title:</label><br><textarea name = 'title' cols = '150' maxlength="150" autofocus required></textarea><br>
			<label class = 'largetext'>Story</label><br><textarea name = 'story' cols = '150' rows = '50' maxlength="50000" required></textarea><br>
			<input type = 'submit' class = 'submitbutton'/>

		</form>
	</div>
</body>