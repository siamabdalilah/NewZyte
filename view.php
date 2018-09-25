<?php
	session_start();
	require 'database.php';
	require 'login.php';


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
		<div class = 'top'>
			<div class = 'title'>
				NewZyte
			</div>

			<div class = 'rightside'>
				<?php
					if (isset($_SESSION['user'])){
						echo "Welcome, ";
						echo htmlspecialchars($_SESSION['user']);

						echo "&nbsp <a href = 'logout.php' class = 'button'> Log Out</a>&nbsp";
						echo "<a href = 'insertstory.php' class = 'button'>Add Story</a><br>
							<a href = 'index.php' class = 'button'>Go Back to Home Page</a>";

					}
					else{
						if ($flag){
							echo "<span class = 'wrong'>Invalid. Please try again</span> &nbsp";
						}
						echo "<form action = '"; echo htmlentities($_SERVER['PHP_SELF']); 
						echo "' method = 'POST'><label class = 'label'>Username:   </label><input type = 'text' name = 'user_name' class = 'input'/>&nbsp
						<label class = 'label'>Password:   </label><input type = 'Password' name = 'password' class = 'input'/><input type = 'submit' class = 'submitbutton' value = 'Login'/></form>";
						echo "<a href = 'register.php' class = 'button'> Register new User</a>";
					}
				?>
		</div>
		<div class = 'middle'>
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