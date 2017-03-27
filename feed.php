<?php
    session_start();

    include_once 'includes/psl-config.php';

    $connection = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
    $self = $_SESSION['name'];
    $public = $_POST['public'];
    $query = "SELECT * FROM transactions";

    if ($public == "false") {
        $query .= " WHERE (sender = ? OR receiver = ?) ORDER BY timestamp DESC LIMIT 5";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "ss", $self, $self);
    } else {
        $query .= " ORDER BY timestamp DESC LIMIT 30";
        $stmt = mysqli_prepare($connection, $query);
    }

    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $time, $sender, $reciever, $amount, $comment, $private);

    $line = array();

    while (mysqli_stmt_fetch($stmt)) {
        if ($public == "false") {
            if ($sender == $self) {
                $subject = "To " . $reciever;
            } else {
                $subject = "From " . $sender;
            }
            if ($private) {
                $comment = "<i class='fa fa-unlock-alt fa-fw fa-lg'></i> " . $comment;
            }
        } else {
            $subject = $sender . "<br>to<br>" . $reciever;
            if ($private) {
                if ($sender == $self || $reciever == $self) {
                    $comment = "<i class='fa fa-unlock-alt fa-fw fa-lg'></i> " . $comment;
                } else {
                    $comment = "<i class='fa fa-lock fa-fw fa-lg'></i> private comment";
                }
            }
        }
        $res = array('public' => $public, 'subject' => $subject, 'time' => $time, 'comment' => $comment, 'amount' => $amount);
        $line[] = $res;
    }
    $jsonline = json_encode($line);
    echo $jsonline;
    mysqli_stmt_close($stmt);
    mysqli_close($connection);
?>
