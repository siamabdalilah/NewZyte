<?php
	session_start();
	require 'database.php';
	//if (isset$_SESSION['user'])
?>


<!doctype html>


<html lang = 'en'>
	<head>
		<title>NewsSite</title>

	</head>

	<body>
		<div>
			<!-- Login if No user -->

			<?php
				if (isset($_SESSION['user'])){
					echo htmlspecialchars($_SESSION['user']);

					// ADD LOGOUT FUNCTIONALITY
					echo "<a herf = \"logout.php\"> Log Out</a>";
				}
				else{
					// HIDE PASSWORD
					echo "<form method = 'POST'><label>Username:</label><input type = 'text' name = 'user_name'/><br>
					<label>Password</label><input type = 'Password' name = 'password'/><input type = 'submit'/></form>";
					echo "<a> Register new User</a>";
				}
			?>
			<!-- Username and logout if user -->
		</div>

		<div>
			<!-- List all stories -->
			<?php
				$stmt = $sqli->prepare("select title from stories");
				if (!$stmt){
					printf("Query Prep Failed: %s\n", $sqli->error);
					exit;
				}

				$stmt->execute();

				$stmt->bind_result($title);

				while($stmt->fetch()){
					echo "htmlspecialchars($title)<br>";
				}
			?>
		</div>
	</body>
</html>
