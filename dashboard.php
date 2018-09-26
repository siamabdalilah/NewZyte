<?php
	session_start();
	require 'database.php';

	//if no user is logged in, abort
	if (!isset($_SESSION['user'])){
		header("Location: index.php");
		exit;
	}

?>

<!doctype html>

<html lang ='en'>
	<head>
		<title>Dashboard</title>
	</head>

	<body>
		<div class = 'top'>
			<div class = 'title'>
				NewZyte
			</div>

			<div class = 'rightside'>
				<?php
					echo "Welcome, ";
					echo htmlspecialchars($_SESSION['user']);

					echo "&nbsp <a href = '$outlink' class = 'button'> Log Out</a>&nbsp";
					echo "<a href = 'insertstory.php' class = 'button'>Add Story</a>&nbsp<a href = 'index.php' class = 'button'>Home</a>";
				?>
			</div>
		</div>
		<div class = 'middle'>
			<?php
				$stmt = $sqli->prepare('select stories, hidd, id, link from stories where owner = ? order by time desc');
				$stmt->bind_param('s', $_SESSION['user']);
				$stmt->execute();
				$stmt->bind_result($story, $hid, $id, $link);

				while ($stmt->fetch()){
					$hidd = 'hidden';
					if ($hid == 0){
						$hidd = 'not hidden';
					}
					echo "<a class = 'contentwrap' href = '"; echo htmlspecialchars($link);
					echo "'>";
					echo "<div class = 'content'>";
					echo htmlspecialchars($title);
					echo "<br>$hidd";
					echo "</span></div></a>";
					echo "<br><a href = 'togglehidden.php?id=".$id."'>Toggle-Hidden</a><br><br>"
				}
			?>
		</div>
	</body>
</html>
