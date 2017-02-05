<?php session_start();


 ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Dashboard</title>
		<!-- Stylesheet links-->
		<link rel="stylesheet" href="css/dashboard.css">
		<!-- Script links-->
	</head>
	<body>
		<header id="topbar">
			<div id="user">
				<p class="username">Luca Bulletti</p>
				<div class="userimg"><img src=""></div>
				<nav id="ddmenu">
					<li class="menu"><a href="">Profile</a></li>
					<li class="menu"><a href="">Dashboard</a></li>
					<li class="menu"><a href="">Ranking</a></li>
					<li class="menu"><a href="">Settings</a></li>
					<li class="menu"><a href="">Log out</a></li>
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
