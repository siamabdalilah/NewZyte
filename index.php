<?php
	session_start();
	require 'database.php';
	$flag = false;

	if (isset($_POST['user_name']) && isset($_POST['password'])){
		$pass = htmlentities($_POST['password']);
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
		<title>NewZyte</title>
		<link href = 'index.css' rel = 'stylesheet' type = 'text/css'/>
	</head>

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
						echo "<a href = 'insertstory.php' class = 'button'>Add Story</a><br>";

					}
					else{
						if ($flag){
							echo "<span class = 'wrong'>Invalid. Please try again</span> &nbsp";
						}
						echo "<form action = '"; echo htmlentities($_SERVER['PHP_SELF']); 
						echo "' method = 'POST'><label class = 'label'>Username:   </label><input type = 'text' name = 'user_name' class = 'input'/>&nbsp
						<label class = 'label'>Password:   </label><input type = 'Password' name = 'password' class = 'input'/><input type = 'submit' class = 'submitbutton'/></form>";
						echo "<a href = 'register.php' class = 'button'> Register new User</a>";
					}
				?>
			</div>
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
					echo "<a href = '"; echo htmlspecialchars($link); echo "'>";
					echo htmlspecialchars($title);
					echo "</a><br><br>";
				}
			?>
		</div>
	</body>
</html>
