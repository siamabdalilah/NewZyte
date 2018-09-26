<?php
	session_start();
	require 'database.php';

	//make sure user is logged in, the story is question exists and the user is
	//the owner
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

	//get story to update
	$getstory = $sqli->prepare('select stories, title from stories where id = ?');
	$getstory->bind_param('s', $id);
	$getstory->execute();
	$getstory->bind_result($story, $title);
	$getstory->fetch();
	$getstory->close();

?>

<!doctype html>

<html lang = 'en'>
<head>
	<title>Add Story</title>
	<link href = 'stylesheet.css' rel ='stylesheet' type = 'text/css'/>
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
					echo "<a href = 'index.php' class = 'button'>Home</a>&nbsp<a href ='dashboard.php' class = 'button'>Dashboard</a>";
				?>
			</div>
		</div>

		<div class = 'middle'>
			<form action = 'storyupdater.php' method = 'post'>
				<label class = 'largetext'>Add Story Title:</label><br><textarea name = 'title' cols = '150' maxlength="150" autofocus required><?php echo $title?></textarea><br>
				<label class = 'largetext'>Story</label><br><textarea name = 'story' cols = '150' rows = '30' maxlength="50000" required><?php echo $story?></textarea><br>
				<input type = 'hidden' name = 'id' value = "<?php echo $id ?>"/>
				<input type = 'hidden' value = "<?php echo $_SESSION['token']; ?>" name = 'csrf'/>
				<input value = 'update' type = 'submit' class = 'submitbutton'/>

			</form>
		</div>
	</body>
</html>