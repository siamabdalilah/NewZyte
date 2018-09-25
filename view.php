<?php
	session_start();
	require 'database.php';
	require 'login.php';


	$id = isset($_GET['id'])? $_GET['id'] : null;
	$usr = isset($_SESSION['user'])? $_SESSION['user'] : null;
	$stmt = $sqli->prepare("select title, stories, owner, time from stories where id = ?");
	$stmt->bind_param('s', $id);
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $sqli->error);
		exit;
	}	
	$stmt->execute();
	$stmt->bind_result($title, $story, $owner, $time);


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
			<span style = "font-size: 15px;"> Comments:</span><br>
		<?php
			if ($stmt->fetch()){
				// .largetext and .smalltext needs css
				echo "<span class = 'largetext'> $title </span> <br><span class = 'smalltext'>Written by $owner. Posted: $time </span>";
				if ($user === $_SESSION['user']){
					echo "<br><a href = 'updatestory.php' class = 'button'>Edit</a><a href = 'deletestory.php' class = 'button'>Delete</a>";
				}
				
				echo "<p>$story</p>";
				$stmt->close();
				$comments = $sqli->prepare("select owner, comment, time from comments where story = ?");
				$comments->bind_param('s', $id);
				$comments->execute();
				$comments->bind_result($user, $comment, $time);

				echo "<div >";
				while($comments->fetch()){
					// .comment needs css
					echo "<div class = 'comment'>";
					echo "<div>$user writes:<br><p>$comment</p><br><br></div>";
					echo "<span class = 'smalltext> Posted: $time.";
					if ($user === $_SESSION['user']) {
						echo "&nbsp <a href = 'updatecomment.php'>Edit</a><a href = 'deletecomment.php'>Delete</a>";
					}
					echo "</div>";
				}
				echo "</div>";

				// ADD PLACE FOR COMMENTING;
			}
			else{
				echo "<h1> Invalid. Story not found</h1>";
			}
		?>
		</div>
	</body>
</html>