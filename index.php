<?php
	session_start();
	require 'database.php';
	$flag = false;

	if (isset($_POST['user_name']) && isset($_POST['password'])){
		$pass = $_POST['password'];
		$hashret = $sqli->prepare('select password_hash from users where user_name = ?');
		$hashret->bind_param('s', $_POST['user_name']);

		$hashret->execute();
		$hashret->bind_result($hash);
		$hashret->fetch();
		
		if (password_verify($pass, $hash)){
			$_SESSION['user'] = $_POST['user_name'];
		}

		else{
			$flag = true;
		}
		while($hashret->fetch()){
			// do nothing
		}
	}
?>


<!doctype html>


<html lang = 'en'>
	<head>
		<title>NewsSite</title>

	</head>

	<body>
		<div>

			<?php
				if (isset($_SESSION['user'])){
					echo htmlspecialchars($_SESSION['user']);

					echo "<br> <a href = \"logout.php\"> Log Out</a><br>";
					echo "<a href = 'insertstory.php'>Add Story</a><br><br><br>";

				}
				else{
					if ($flag){
						echo "Invalid. Please try again<br>";
					}
					echo "<form action = '"; echo htmlentities($_SERVER['PHP_SELF']); 
					echo "' method = 'POST'><label>Username:</label><input type = 'text' name = 'user_name'/><br>
					<label>Password</label><input type = 'Password' name = 'password'/><input type = 'submit'/></form>";
					echo "<a href = 'register.php'> Register new User</a>";
				}
			?>
		</div>

		<div>
			<!-- List all stories -->
			<?php
				$stmt = $sqli->prepare("select title, link from stories");
				if (!$stmt){
					printf("Query Prep Failed: %s\n", $sqli->error);
					exit;
				}

				$stmt->execute();

				$stmt->bind_result($title, $link);

				while($stmt->fetch()){
					echo "<a href = '{htmlspecialchars($link)}'>htmlspecialchars($title)</a><br><br>";
				}
			?>
		</div>
	</body>
</html>
