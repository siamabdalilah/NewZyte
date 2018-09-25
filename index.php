<?php
	session_start();
	require 'database.php';
	require 'login.php'
?>


<!doctype html>


<html lang = 'en'>
	<head>
		<title>NewZyte</title>
		<link href = 'stylesheet.css' rel = 'stylesheet' type = 'text/css'/>
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
						echo "<a href = 'insertstory.php' class = 'button'>Add Story</a>";

					}
					else{
						if ($flag){
							echo "<span class = 'wrong'>Invalid. Please try again</span> &nbsp";
						}
						echo "<form action = '"; echo htmlentities($_SERVER['PHP_SELF']); 
						echo "' method = 'POST'><label class = 'label'>Username:   </label><input type = 'text' name = 'user_name' class = 'input'/>&nbsp
						<label class = 'label'>Password:   </label><input type = 'Password' name = 'password' class = 'input'/><input type = 'submit' class = 'submitbutton' value = 'Login'/></form>";
						echo "<a href = 'register.php' class = 'button'> Register New User</a>";
					}
				?>
			</div>
		</div>

		<div class = 'middle'>
			<?php
				// $stmt = $sqli->prepare("select title, link, owner, time from stories");
				// if (!$stmt){
				// 	printf("Query Prep Failed: %s\n", $sqli->error);
				// 	exit;
				// }

				// $stmt->execute();

				// $stmt->bind_result($title, $link, $user, $time);

				// while($stmt->fetch()){
				// 	echo "<a class = 'contentwrap' href = '"; echo htmlspecialchars($link);
				// 	echo "'>";
				// 	echo "<div class = 'content'>";
				// 	echo htmlspecialchars($title);
				// 	echo "<br><span class = 'smalltext'> Written by ";
				// 	echo htmlspecialchars($user);
				// 	echo ". Posted: ";
				// 	echo htmlspecialchars($time);
				// 	echo "</span></div></a>";
				// }
			?>
		</div>
	</body>
</html>
