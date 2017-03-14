<?php

    // include local database credentials
    include_once 'includes/psl-config.php';

    session_start();
    $connection = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
    $query = "SELECT name FROM main WHERE name LIKE ?";
    $stmt = mysqli_prepare($connection, $query);
    $fuzzy = $_POST['user'] . "%";

    mysqli_stmt_bind_param($stmt, "s", $fuzzy);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $receiver);
    mysqli_stmt_fetch($stmt);

    if ($receiver !== $_SESSION['name']) {
        echo $receiver;
    } else {
        echo "";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($connection);
?>
