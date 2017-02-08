<?php session_start(); ?>
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
		<script type="text/javascript" src="js/jquery2.1.4.min.js"></script>
		<script type="text/javascript" src="js/async.js"></script>
		<script type="text/javascript" src="js/fuzzy.js"></script>
	</head>
	<body>
		<header id="topbar">
			<div id="user">
				<p class="username"><?php echo $_SESSION['name']; ?></p>
				<div class="userimg"><img src=""></div>
				<nav id="ddmenu">
					<li class="menu"><a href=""><i class="fa fa-user-o fa-fw fa-lg"></i> Profile</a></li>
					<li class="menu"><a href=""><i class="fa fa-home fa-fw fa-lg"></i> Dashboard</a></li>
					<li class="menu"><a href=""><i class="fa fa-trophy fa-fw fa-lg"></i> Ranking</a></li>
					<li class="menu"><a href=""><i class="fa fa-cog fa-fw fa-lg"></i> Settings</a></li>
					<li class="menu"><a href="logout.php"><i class="fa fa-sign-out fa-fw fa-lg"></i> Log out</a></li>
				</nav>
			</div>
		</header>
		<section id="main">
			<form id="karma" action="dashboard.php" method="post">
				<div id="fuzzy"></div>
				<input type="text" name="destination" id="destination" placeholder="user" value="" autocomplete="off">
				<input type="number" name="karma" placeholder="karma">
				<input type="text" name="comment" value="" placeholder="comment" autocomplete="off">
				<input type="checkbox" name="private" id="private" value="1">
				<label for="private"><i class="fa fa-check fa-fw"></i>  private</label>
				<button type="submit" name="ktransfer" id="ktransferbtn"><span>Transfer Karma  </span><i class="fa fa-lg fa-fw fa-exchange"></i></button>
			</form>
			<div class="msg"></div>
		</section>
		<section id="display">
			<div id="karmadisplay"><?php echo $_SESSION['karma'];?></div>
		</section>
	</body>
</html>
