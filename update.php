<?php session_start();
	$connection = mysqli_connect("localhost", "moriarty", "mogneHavcocoj", "moriarty_75");
	$query = "SELECT points FROM main WHERE name LIKE ?";
	$stmt = mysqli_prepare($connection, $query);
	$self = $_SESSION['user'];
	mysqli_stmt_bind_param($stmt, "s", $self);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $liveKarma);
	mysqli_stmt_fetch($stmt);
	if ($liveKarma !== $_SESSION['karma']) {
		$_SESSION['karma'] = $liveKarma;
		$msg = array('update' => 'true', 'points' => $_SESSION['karma']);
		$jsonmsg = json_encode($msg);
		echo $jsonmsg;
	} else {
		$msg = array('update' => 'false');
		$jsonmsg = json_encode($msg);
		echo $jsonmsg;
	}
	mysqli_stmt_close($stmt);
	mysqli_close($connection);
?>
