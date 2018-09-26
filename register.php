<?php
	session_start();
	require 'database.php';
	if (isset($_SESSION['user'])){
		header("Location: index.php");
		exit;
	}
?>

<!doctype html>

<html lang = 'en'>
	<head>
		<title>Create New User</title>
		<link href = 'stylesheet.css' rel = 'stylesheet' type = 'text/css'/>
	</head>

	<body>
		<div class = 'top'>
			<div class = 'title'>
				NewZyte
			</div>

			<div class = 'rightside'>
				<?php
					echo "<form action = '"; echo htmlentities($_SERVER['PHP_SELF']); 
					echo "' method = 'POST'><label class = 'label'>Username:   </label><input type = 'text' name = 'user_name' class = 'input'/>&nbsp;
					<label class = 'label'>Password:   </label><input type = 'Password' name = 'password' class = 'input'/><input type = 'submit' class = 'submitbutton' value = 'Login'/></form>";
					echo "<a href = 'index.php' class = 'button'>Home</a>";
				?>
			</div>
		</div>
		<div id = 'regform'>
			<br><br><br>
			<span style = "font-size: 15px">Register New User:</span><br>
			<?php
				if (isset($_POST['user'])  && isset($_POST['pass']) && isset($_POST['confpass'])){
					$stmt = $sqli->prepare("select count(*) from users where user_name = ?");
					$stmt -> bind_param('s', $_POST['user']);
					$stmt->execute();
					$stmt->bind_result($count);
					$stmt->fetch();
					
					// if username exists, print error
					if ($count != 0){
						echo "Username already exists<br>";
					}

					// if passwords do not match, print error
					else if (!($_POST['pass'] === $_POST['confpass'])){
						echo "Passwords do no match<br>";
					}
					else{
						$stmt->fetch();
						$pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);
						$usrins = $sqli->prepare("insert into users (user_name, password_hash) values ( ?, ? )");
						if (!$usrins){
							echo $sqli->errno;
							exit;
						}
						$usrins->bind_param('ss', $_POST['user'], $pass);

						$usrins->execute();

						//if all is well, login user after registration
						session_start();
						$_SESSION['user'] = $_POST['user'];
						$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
						header("Location: index.php");
						exit;
					}
				}
			?>
			<form action = "<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method = 'post'>
				<label class = 'label'>Username:</label><br>
				<input type = 'text' name = 'user' class = 'input'/><br>
				<label class = 'label'>Password:</label><br>
				<input type = 'password' name = 'pass' class = 'input'/><br>
				<label>Confirm Password:</label><br>
				<input type = 'password' name = 'confpass' class = 'input'/><br>
				<input type = 'submit' class = 'submitbutton'>
			</form>
		</div>
	</body>
</html>