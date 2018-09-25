<?php	
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
		$hashret->close();
	}
?>