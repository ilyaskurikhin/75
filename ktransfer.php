<?php
	session_start();
	$connection = mysqli_connect("localhost", "moriarty", "mogneHavcocoj", "moriarty_75");
	$sender = $_SESSION['name'];
	$fuzzyReceiver = $_POST['destination'];
	$amount = $_POST['karma'];
	$comment = $_POST['comment'];
	$private = isset($_POST['private']) ? 1 : 0;

	// check if receiver is valid.
	$query = "SELECT name FROM main WHERE name LIKE ?";
	$stmt = mysqli_prepare($connection, $query);
	$fuzzy = "%" . $fuzzyReceiver . "%";
	mysqli_stmt_bind_param($stmt, "s", $fuzzy);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_store_result($stmt);

	if (mysqli_stmt_num_rows($stmt) == 1) {
		$validReciever = true;
	} else {
		$validReciever = false;
		$err = "Invalid user";
	}
	mysqli_stmt_bind_result($stmt, $receiver);
	mysqli_stmt_fetch($stmt);
	mysqli_stmt_close($stmt);

	// check if amount is transferable
	if ($amount < 0 && $validReciever){
		$query = "SELECT amount FROM transactions WHERE sender=? AND receiver=?";
		$stmt = mysqli_prepare($connection, $query);
		mysqli_stmt_bind_param($stmt, "ss", $sender, $receiver);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		mysqli_stmt_bind_result($stmt, $transferred);
		if (mysqli_stmt_num_rows($stmt) > 0) {
			$maxDroppable = 0;
			while (mysqli_stmt_fetch($stmt)) {
				$maxDroppable += $transferred;
			}
			if ($amount < 0 && ($maxDroppable + $amount) < 0) {
				$validKarma = false;
				$err = "You can't take away karma you didn't give.";
			} else {
				$validKarma = true;
			}
		} else {
			$validKarma = false;
			$err = "You can't take away karma you didn't give.";
		}
		mysqli_stmt_close($stmt);
	} else if ($amount == 0) { // zero value
		$validKarma = false;
		$err = "Invalid karma amount!";
	} else if ($amount > $_SESSION['karma']) {
		$validKarma = false;
		$err = "Invalid karma amount!";
	} else {
		$validKarma = true;
	}

	// transfer karma after validity check
	if ($validReciever && $validKarma) {
		$_SESSION['transferring'] = true;
		$query = "UPDATE main SET points= points + ? WHERE name=?";
		$stmt = mysqli_prepare($connection, $query);
		mysqli_stmt_bind_param($stmt, "is", $amount, $receiver);
		mysqli_stmt_execute($stmt);
		$invertedAmount = $amount * -1;
		$_SESSION['karma'] = $_SESSION['karma'] + $invertedAmount;
		mysqli_stmt_bind_param($stmt, "is", $invertedAmount, $sender);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		$query = "INSERT INTO transactions (sender, receiver, amount, comment, private) VALUES (?,?,?,?,?)";
		$stmt = mysqli_prepare($connection, $query);
		mysqli_stmt_bind_param($stmt, "ssisi", $sender, $receiver, $amount, $comment, $private);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		$successmsg = 'Transaction successfull!';
		$msg = array('success' => 'true', 'message' => $successmsg, 'points' => $_SESSION['karma'], 'oldpoints' => $_SESSION['karma'] - $invertedAmount);
		$jsonmsg = json_encode($msg);
		echo $jsonmsg;
		$_SESSION['transferring'] = false;
	} else {
		$msg = array('success' => 'false', 'message' => $err);
		$jsonmsg = json_encode($msg);
		echo $jsonmsg;
	}
	mysqli_close($connection);
?>
