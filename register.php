<?php

    // include local database credentials
    include_once 'includes/psl-config.php';

    session_start();
    $connection = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
    $aok = true;

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        if ($_POST['password'] == $_POST['password2']) {
            $password = hash('sha256', $_POST['password']);
        } else {
            $aok = false;
            $err = "password discrepancy.";
        }
        $name = $_POST['name'];
        $roomNumber = $_POST['roomNumber'];
        $query = "SELECT * FROM main WHERE roomNumber = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "i", $roomNumber);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $rn);
        if (mysqli_stmt_fetch($stmt)) {
            $aok = false;
            $err = "An account linked to this room number has already been created.";
        }
        if($aok){
            $query = "INSERT INTO main (roomNumber, user, pw, name) VALUES (?,?,?,?)";
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, "isss",  $roomNumber, $username, $password, $name);
            mysqli_stmt_execute($stmt);
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            //header('Location: dashboard.php');
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>75 - Register</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Stylesheet link -->
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/register.css">
        <!-- Scripts -->
    </head>
    <body>
        <div class="mainbox">
            <h1 class="title"><img src="img/75.coral.png" alt="75 logo"></h1>
            <p class="err">
                <?php
                    if (!$aok) {
                    echo $err;
                    }
                ?>
            </p>
            <form class="" action="register.php" method="post">
                <input type="email" name="username" placeholder="email"/>
                <input type="text" name="name" placeholder="first & last name"/>
                <input type="password" name="password" placeholder="password"/>
                <input type="password" name="password2" placeholder="repeat password"/>
                <input type="number" name="roomNumber" placeholder="room number" min="1" max="17"/>
                <input type="submit" name="submit" value="Register"/>
            </form>
        </div>
    </body>
</html>
