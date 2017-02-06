<?php session_start();
	$connection = mysqli_connect("localhost", "moriarty", "mogneHavcocoj", "moriarty_75");
	$query = "SELECT name, points FROM main WHERE user = ?";
	$stmt = mysqli_prepare($connection, $query);
	mysqli_stmt_bind_param($stmt, "s", $_SESSION["username"]);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $name, $points);
	mysqli_stmt_fetch($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($connection);
 ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Dashboard</title>
		<!-- Stylesheet links-->
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/dashboard.css">
		<link rel="stylesheet" href="css/fontawesome/font-awesome.min.css">
		<!-- Script links-->
	</head>
	<body>
		<header id="topbar">
			<div id="user">
				<p class="username"><?php echo $name ?></p>
				<div class="userimg"><img src=""></div>
				<nav id="ddmenu">
					<li class="menu"><a href=""><i class="fa fa-user-o fa-fw fa-lg"></i> Profile</a></li>
					<li class="menu"><a href=""><i class="fa fa-home fa-fw fa-lg"></i> Dashboard</a></li>
					<li class="menu"><a href=""><i class="fa fa-trophy fa-fw fa-lg"></i> Ranking</a></li>
					<li class="menu"><a href=""><i class="fa fa-cog fa-fw fa-lg"></i> Settings</a></li>
					<li class="menu"><a href="index.php"><i class="fa fa-sign-out fa-fw fa-lg"></i> Log out</a></li>
				</nav>
			</div>
		</header>
		<section id="main">
			<div id="karma">
				<input type="text" name="destination" value="" placeholder="user">
				<input type="number" name="points" min="1" placeholder="karma">
				<input type="text" name="comment" value="" placeholder="comment">
				<div class="pcheckbox">
					<input type="checkbox" name="private" id="private">
					<label for="private">private</label>
				</div>
				<input type="submit" name="submit" value="Transfer karma">
			</div>
		</section>
	</body>
</html>
