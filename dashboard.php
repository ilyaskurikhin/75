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
        <title>Dashboard</title>
        <!-- Stylesheet links -->
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/dashboard.css">
        <!-- FontAwesome-->
        <link rel="stylesheet" href="css/fontawesome/font-awesome.min.css">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
        <!-- Script links -->
        <script type="text/javascript" src="js/jquery2.1.4.min.js"></script>
        <script type="text/javascript" src="js/async.js"></script>
        <script type="text/javascript" src="js/fuzzy.js"></script>
        <script type="text/javascript" src="js/feed.js"></script>
    </head>
    <body>
        <header id="topbar">
            <div id="user">
                <p class="username"><?php echo $_SESSION['name']; ?></p>
                <div class="userimg"><img src=""></div>
                <nav id="ddmenu">
                    <li class="menu"><a href=""><i class="fa fa-user-o fa-fw fa-lg"></i> Profile</a></li>
                    <li class="menu"><a href=""><i class="fa fa-home fa-fw fa-lg"></i> Dashboard</a></li>
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
        <section id="display">
            <div id="karmadisplay">
                <div class="pointer pointer1"></div>
                <div class="pointer pointer2"></div>
                <div class="pointer pointer3"></div>
                <div class="pointer pointer4"></div>
                <div class="cover"></div>
                <p><?php echo $_SESSION['karma'];?></p>
            </div>
        </section>
        <section id="transaction">
            <form id="karma" action="dashboard.php" method="post">
                <div id="fuzzy"></div>
                <input type="text" name="destination" id="destination" placeholder="user" value="" autocomplete="off">
                <input type="number" name="karma" placeholder="karma">
                <input type="text" name="comment" value="" placeholder="comment" autocomplete="off">
                <input type="checkbox" name="private" id="private" value="1">
                <label for="private"><i class="fa fa-check fa-fw"></i>  private</label>
                <button type="submit" name="ktransfer" id="ktransferbtn"><span>Send Karma  </span><i class="fa fa-lg fa-fw fa-paper-plane"></i></button>
            </form>
            <div class="msg"></div>
        </section>
        <section id="feed">
            <div id="persfeed">
            </div>
        </section>
    </body>
</html>
