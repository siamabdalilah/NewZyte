<!doctype html>

<html lang = 'en'>
	<head>
		<title>Create New User</title>
	</head>

<?php
	require 'database.php';
	if (isset($_POST['user'])  && isset($_POST['pass']) && isset($_POST['confpass'])){
		$stmt = $sqli->prepare("select count(*) from users where user_name = ?");
		$stmt -> bind_param('s', $_POST['user']);
		$stmt->execute();
		$stmt->bind_result($count);

		if ($count != 0){
			echo "Username already exists<br>";
		}
		else if (!($_POST['pass'] === $_POST['confpass'])){
			echo "Passwords do no match<br>";
		}
		else{
			$pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);
			$usrins = $sqli->prepare("insert into users (user_name, password_hash) values (?, ?)");
			$usrins->bind_param('ss', $_POST['user'], $pass);
			$usrins->execute();
			session_start();
			$_SESSION['user'] = $_POST['user'];
			header("Location: index.php");
			exit;
		}
	}
?>




	<body>
		<form action = "<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method = 'post'>
			<label>Username:</label>
			<input type = 'text' name = 'user'/><br>
			<label>Password:</label>
			<input type = 'password' name = 'pass'/><br>
			<label>Confirm Password:</label>
			<input type = 'password' name = 'confpass'/><br>
			<input type = 'submit'>
		</form>
	</body>
</html>