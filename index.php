<?php session_start()
	// $connection = mysqli_connect("localhost", "moriarty", "mogneHavcocoj", "moriarty_75");
	// $_SESSION['loggedIn'] = false;
	//
	// if (isset($_POST)) {
	// 	if ($_POST['username'] != "" && $_POST['password'] != "") {
	// 		$empty = false;
	// 		$username = $_POST['username'];
	// 		$password = $_POST['password'];
	// 		$hashed_password = hash('sha265', $password);
	// 	} else {
	// 		$empty = true;
	// 	}
	// }

?>
<!DOCTYPE html>
<html>
<head>
	<title> Login 75 </title>
	<meta charset="utf-8">
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
		  	<input type="submit" value="Login"/>
		</form>
	</div>
</body>
</html>
