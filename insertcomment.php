<?php
	session_start();
	require 'database.php';

	if (!isset($_SESSION['user']) || !isset($_GET['id'])){
		header("Location: index.php");
		exit;
	}
	$stmt = $sqli->prepare('select stories from stories where id = ?');
	$stmt->bind_param('d', $id);
	$stmt->execute();
	$stmt->bind_result($usr);
	if (!$stmt->fetch()){
		header("Location: index.php");
		exit;
	}
	$stmt->close();
	$id = $_GET['id'];

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
		<form action = 'commentinserter.php' method = 'post'>
			<label class = 'largetext'>Comment</label><br><textarea name = 'comment' cols = '4' rows = '30' maxlength="50000" required autofocus></textarea><br>
			<input type = 'hidden' value = "<?php echo $id?>" name = 'id'/>
			<input type = 'submit' class = 'submitbutton'/>
		</form>
	</div>
</body>