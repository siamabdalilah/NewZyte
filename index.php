<?php
	session_start();
	$sqli = new mysqli('localhost', 'wustlinst', 'wustl_pass', 'newssite');

	if ($sqli->connect_errno){
		printf("Connection Failed: $s\n", $sqli->connect_errno);
		exit;
	}
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
					echo $_SESSION['user'];
					// ADD LOGOUT FUNCTIONALITY
				}
				else{
					// HIDE PASSWORD
					echo "<form method = 'POST'><input type = 'text' name = 'user_name'/><br>
					<input type = 'text' name = 'password'/><input type = 'submit'/>";
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
