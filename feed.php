<?php
	session_start();
	$connection = mysqli_connect("localhost", "moriarty", "mogneHavcocoj", "moriarty_75");
	$self = $_SESSION['name'];
	$public = $_POST['public'];
	$query = "SELECT * FROM transactions";
	if (!$public) {
		$query .= " WHERE (sender = ? OR reciever = ?)";
		$stmt = mysqli_prepare($connection, $query);
		mysqli_stmt_bind_param($stmt, "ss", $self, $self);
	} else {
		$stmt = mysqli_prepare($connection, $query);
	}
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $time, $sender, $reciever, $amount, $comment, $private);
	while (mysqli_stmt_fetch($stmt)) {
		if (!$private) {
			$res = "<p>" .  . "</p><br>" // not finished, JSON instead of echoing html
		} else {
			$res = "<p>" .  . "</p><br>" // not finished, JSON instead of echoing html
		}
	}
	echo $res;
	mysqli_stmt_close($stmt);
	mysqli_close($connection);
?>
