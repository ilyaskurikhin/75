<?php
    session_start();

    include_once 'includes/psl-config.php';

    $connection = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
    $query = "SELECT name, points FROM main ORDER BY points DESC";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $name, $points);

    $line = "";
    $pos = 1;
    $i = 0;
    while (mysqli_stmt_fetch($stmt)) {
        if ($i == 0) {
            $prevpoints = $points;
        }
        if ($points < $prevpoints && $i > 0) {
            $pos++;
            $prevpoints = $points;
        }
        $i++;
        $msg = "<tr><td>" . $pos . "</td><td><div class='circle'></div>" . $name . "</td><td>" . $points . "</td></tr>"; //html here
        $line .= $msg;
    }
    mysqli_stmt_close($stmt);
    mysqli_close($connection);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ranking</title>
        <!-- Stylesheet links -->
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/ranking.css">
        <!-- FontAwesome-->
        <link rel="stylesheet" href="css/fontawesome/font-awesome.min.css">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
        <!-- Script links -->
        <script type="text/javascript" src="js/jquery2.1.4.min.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
    </head>
    <body>
        <header id="topbar">
            <div id="user">
                <p class="username"><?php echo $_SESSION['name']; ?></p>
                <div class="userimg"><img src=""></div>
                <nav id="ddmenu" class="hidden">
                    <li class="menu"><a href=""><i class="fa fa-user-o fa-fw fa-lg"></i> Profile</a></li>
                    <li class="menu"><a href="dashboard.php"><i class="fa fa-home fa-fw fa-lg"></i> Dashboard</a></li>
                    <li class="menu"><a href="timeline.php"><i class="fa fa-globe fa-fw fa-lg"></i> Timeline</a></li>
                    <li class="menu"><a href=""><i class="fa fa-trophy fa-fw fa-lg"></i> Ranking</a></li>
                    <li class="menu"><a href=""><i class="fa fa-cog fa-fw fa-lg"></i> Settings</a></li>
                    <li class="menu"><a href="logout.php"><i class="fa fa-sign-out fa-fw fa-lg"></i> Log out</a></li>
                </nav>
            </div>
        </header>
        <div class="banner inactive">
            <div class="usericon"></div>
                <p class="message"></p>
            <div class="cross"></div>
        </div>
        <section id="ranking">
            <table id="ranktb">
                <tr>
                    <td>Position</td>
                    <td>Name</td>
                    <td>Points</td>
                </tr>
                <?php echo $line ?>
            </table>
        </section>
    </body>
</html>
