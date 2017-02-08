<?php
	session_start();
	$connection = mysqli_connect("localhost", "moriarty", "mogneHavcocoj", "moriarty_75");
	$aok = true;
	$sender = $_SESSION['name'];
	$preceiver = $_POST['destination'];
	$amount = $_POST['karma'];
	$comment = $_POST['comment'];
	$private = isset($_POST['private']) ? 1 : 0;
	// check if receiver is valid.
	$query = "SELECT name FROM main WHERE name LIKE ?";
	$stmt = mysqli_prepare($connection, $query);
	$fuzzy = "%" . $preceiver . "%";
	mysqli_stmt_bind_param($stmt, "s", $fuzzy);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_store_result($stmt);
	if (mysqli_stmt_num_rows($stmt) != 1) {
		$aok = false;
		$err = "Invalid user";
	}
	mysqli_stmt_bind_result($stmt, $receiver);
	mysqli_stmt_fetch($stmt);
	mysqli_stmt_close($stmt);
	// check if amount is transferable.
	if ($amount < 0 && $aok){
		$query = "SELECT amount FROM transactions WHERE sender=? AND receiver=?";
		$stmt = mysqli_prepare($connection, $query);
		mysqli_stmt_bind_param($stmt, "ss", $sender, $receiver);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		mysqli_stmt_bind_result($stmt, $transferred);
		if (mysqli_stmt_num_rows($stmt) > 0) {
			$max_droppable = 0;
			while (mysqli_stmt_fetch($stmt)) {
				$max_droppable += $transferred;
			}
			if ($amount < 0 && ($max_droppable + $amount) < 0) { // negative values
				$aok = false;
				$err = "You can't take away karma you didn't give.";
			}
		} else {
			$aok = false;
			$err = "You can't take away karma you didn't give.";
		}
		mysqli_stmt_close($stmt);
	} else if ($amount == 0) { // zero value
		$aok = false;
		$err = "Invalid karma amount!";
	}
	if ($aok) {
		$query = "UPDATE main SET points= points + ? WHERE name=?";
		$stmt = mysqli_prepare($connection, $query);
		mysqli_stmt_bind_param($stmt, "is", $amount, $receiver);
		mysqli_stmt_execute($stmt);
		$inv_amount = $amount * -1;
		$_SESSION['karma'] = $_SESSION['karma'] + $inv_amount;
		mysqli_stmt_bind_param($stmt, "is", $inv_amount, $sender);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		$query = "INSERT INTO transactions (sender, receiver, amount, comment, private) VALUES (?,?,?,?,?)";
		$stmt = mysqli_prepare($connection, $query);
		mysqli_stmt_bind_param($stmt, "ssisi", $sender, $receiver, $amount, $comment, $private);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		$msg = array('message' => 'Transaction successfull!', 'karma' => $_SESSION['karma']);
		$jsonmsg = json_encode($msg);
		echo $jsonmsg;
	} else {
		$msg = array('message' => $err);
		$jsonmsg = json_encode($msg);
		echo $jsonmsg;
	}
	mysqli_close($connection);
?>
