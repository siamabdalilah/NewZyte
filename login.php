<?php	
	$flag = false;

	//if username and password are set, check against database and assign
	//session variable
	if (isset($_POST['user_name']) && isset($_POST['password'])){
		$pass = htmlentities($_POST['password']);
		$hashret = $sqli->prepare('select password_hash from users where user_name = ?');
		$hashret->bind_param('s', $_POST['user_name']);

		$hashret->execute();
		$hashret->bind_result($hash);
		$hashret->fetch();
		
		if (password_verify($pass, $hash)){
			$_SESSION['user'] = $_POST['user_name'];
			$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
		}

		else{
			$flag = true;
		}
		$hashret->close();
	}
?>