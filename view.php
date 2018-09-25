<?php
	session_start();
	require 'database.php';
	//if (isset$_SESSION['user'])
	$id = isset($_GET['id'])? $_GET['id'] : null;
	$usr = isset($_SESSION['user'])? $_SESSION['user'] : null;
	$stmt = $sqli->prepare("select title, stories, owner from stories where id = ?");
	$stmt->bind_param('s', $id);
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $sqli->error);
		exit;
	}	
	$stmt->execute();
	$stmt->bind_result($title, $story, $owner);


?>

<!doctype html>

<html lang = 'en'>
	<body>
		<div>
			<!-- TOP -->
		</div>
		<div>
		<?php
			if ($stmt->fetch()){
				echo "<h3> $title </h3> <br>Written by $owner<br><p>$story</p>";
				$stmt->close();
				$comments = $sqli->prepare("select owner, comment from comments where story = ?");
				$comments->bind_param('s', $id);
				$comments->execute();
				$comments->bind_result($user, $comment);

				echo "<div>";
				while($comments->fetch()){
					echo "<div>$user writes:<br><p>$comment</p><br><br></div>";
				}
				echo "</div>";

				// ADD PLACE FOR COMMENTING;
			}
			else{
				echo "<h3> Invalid. Story not found</h3>";
			}
		?>
		</div>
	</body>
</html>