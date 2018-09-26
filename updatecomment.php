<?php
	session_start();
	require 'database.php';

	if (!isset($_SESSION['user']) || !isset($_GET['id'])){
		header("Location: index.php");
		exit;
	}

	//make sure that comment exists and belongs to the user logged in
	$id = $_GET['id'];
	$stmt = $sqli->prepare('select count(*) from comments where id = ? and owner = ?');
	$stmt->bind_param('ds', $id, $_SESSION['user']);
	$stmt->execute();
	$stmt->bind_result($usr);
	$stmt->fetch();
	if (!($usr === 1)){
		header("Location: index.php");
		exit;
	}
	$stmt->close();

	//get information regarding comment in question
	$getcomment = $sqli->prepare('select comment, story from comments where comments.id = ?');
	$getcomment->bind_param('s', $id);
	$getcomment->execute();
	$getcomment->bind_result($comment, $storyid);
	$getcomment->fetch();
	$getcomment->close();
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
					echo $id.' '.$storyid;
					echo htmlspecialchars($_SESSION['user']);

					echo "&nbsp <a href = 'logout.php' class = 'button'> Log Out</a>&nbsp";
					echo "<a href = 'index.php' class = 'button'>Home</a>&nbsp<a href ='dashboard.php' class = 'button'>Dashboard</a>";
				?>
			</div>
		</div>

		<div class = 'middle'>
			<form action = 'commentupdater.php' method = 'post'>
				<label class = 'largetext'>Comment</label><br><textarea name = 'comment' cols = '50' rows = '4' maxlength="50000" required autofocus><?php echo $comment?></textarea><br>
				<input type = 'hidden' value = "<?php echo $id?>" name = 'id'/>
				<input type = 'hidden' value = "<?php echo $storyid?>" name = 'story'/>
				<input type = 'hidden' value = "<?php echo $_SESSION['token']; ?>" name = 'csrf'/>
				<input value = 'update' type = 'submit' class = 'submitbutton'/>
			</form>
		</div>
	</body>
</html>