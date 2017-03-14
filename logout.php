<?php
    session_start();
    $_SESSION = array(); // unsetting $_SESSION vars
    header("Location: index.php");
?>
