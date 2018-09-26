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
	$stmt = $sqli->prepare('select count(*) from stories where id = ?');
	$stmt->bind_param('s', $id);
	$stmt->execute();
	$stmt->bind_result($usr);
	$flag = false;
	$stmt->fetch();
	if (!($usr === 1)){
		header("Location: index.php");
		exit;
	}
	$stmt->close();
	

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
					echo "<a href = 'index.php' class = 'button'>Home</a>";
				?>
			</div>
		</div>

		<div class = 'middle'>
			<form action = 'commentinserter.php' method = 'post'>
				<label class = 'largetext'>Comment</label><br><textarea name = 'comment' cols = '50' rows = '4' maxlength="50000" required autofocus></textarea><br>
				<input type = 'hidden' value = "<?php echo $id?>" name = 'id'/>
				<input type = 'submit' class = 'submitbutton'/>
			</form>
		</div>
	</body>
</html>