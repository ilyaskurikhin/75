<?php
    session_start();
    if (!isset($_SESSION['loggedIn'])) {
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Timeline</title>
        <!-- Stylesheet links -->
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/timeline.css">
        <!-- FontAwesome-->
        <link rel="stylesheet" href="css/fontawesome/font-awesome.min.css">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
        <!-- Script links -->
        <script type="text/javascript" src="js/jquery2.1.4.min.js"></script>
        <script type="text/javascript" src="js/feed.js"></script>
    </head>
    <body>
        <header id="topbar">
            <div id="user">
                <p class="username"><?php echo $_SESSION['name']; ?></p>
                <div class="userimg"><img src=""></div>
                <nav id="ddmenu">
                    <li class="menu"><a href=""><i class="fa fa-user-o fa-fw fa-lg"></i> Profile</a></li>
                    <li class="menu"><a href="dashboard.php"><i class="fa fa-home fa-fw fa-lg"></i> Dashboard</a></li>
                    <li class="menu"><a href=""><i class="fa fa-globe fa-fw fa-lg"></i> Timeline</a></li>
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
        <section>
            <div id="timeline">
            </div>
        </section>
    </body>
</html>
