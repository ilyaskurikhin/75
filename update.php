<?php 

    // include local database credentials
    include_once 'includes/psl-config.php';

    session_start();
    $connection = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
    $query = "SELECT points FROM main WHERE name=?";
    $stmt = mysqli_prepare($connection, $query);
    $self = $_SESSION['name'];
    $loadedKarma = $_SESSION['karma'];
    $transferring = $_SESSION['transferring'];

    mysqli_stmt_bind_param($stmt, "s", $self);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $liveKarma);
    mysqli_stmt_fetch($stmt);
    
    if ($liveKarma !== $loadedKarma && !$_SESSION['transferring']) {
        $_SESSION['karma'] = $liveKarma;
        $msg = array('update' => 'true', 'points' => $liveKarma, 'oldpoints' => $loadedKarma);
        $jsonmsg = json_encode($msg);
        echo $jsonmsg;
    } else {
        $_SESSION['karma'] = $liveKarma;
        $msg = array('update' => 'false');
        $jsonmsg = json_encode($msg);
        echo $jsonmsg;
    }
  
    mysqli_stmt_close($stmt);
    mysqli_close($connection);
?>
