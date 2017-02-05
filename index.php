<?php session_start();
	$connection = mysqli_connect("localhost", "moriarty", "mogneHavcocoj", "moriarty_75");
	$_SESSION['loggedIn'] = false;
	if (isset($_POST)) {
		if ($_POST['username'] != "" && $_POST['password'] != "") {
			$username = $_POST['username'];
			$password = hash('sha256', $_POST['password']);
			$query = "SELECT users FROM main WHERE users = ? AND pw = ?";
			$stmt = mysqli_prepare($connection, $query);
			mysqli_stmt_bind_param($stmt, "ss", $username, $password);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			if (mysqli_stmt_num_rows($stmt) == 1) {
				$_SESSION['loggedin'] = true;
				$_SESSION['username'] = $username;
				header('Location: dashboard.php'); // replace filename with future "home" site
			} else {
				echo "Wrong password or username.<br>";
			}
			mysqli_stmt_close($stmt);
			mysqli_close($connection);
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title> Login 75 </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Stylesheet link -->
	<link rel="stylesheet" type="text/css" href="css/main.css">

	<!-- Scripts -->

</head>
<body>
	<div class="mainbox">
	  	<h1 class="title">Coloc du Mois</h1>
		<form class="" action="index.php" method="post">
			<input type="text" name="username" placeholder="username"/>
		  	<input type="password" name="password" placeholder="password"/>
		  	<input type="submit" name="submit" value="Login"/>
		</form>
	</div>
</body>
</html>
