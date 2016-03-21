<!DOCTYPE html>

<script src="https://apis.google.com/js/platform.js" async defer></script>
<meta name="google-signin-client_id" content="29418959227-cea5c0a516p6nr0ef8n41mh51c4bm05h.apps.googleusercontent.com">

<html lang="sk">
<head>
    <title>Tvorba informacnych systemov</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/sidebar.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <!-- logo -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavBar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="#" class="navbar-brand">Tvorba informacnych systemov</a>
            </div>
            <!-- menu items -->
            <div class="collapse navbar-collapse" id="mainNavBar">
                <ul class="nav navbar-nav">
                    <li><a href="#">Vybrat projekt</a></li>
                    <!-- dropdown menu -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administracia <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Temp 1</a></li>
                            <li><a href="#">Temp 2</a></li>
                            <li><a href="#">Temp 3</a></li>
                        </ul>
                    </li>
                </ul>

                <!-- logout -->
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <button class="btn btn-success navbar-btn" id="login"><a href="../public/create_project">Prihlasenie</a></button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="wrapper">
        <!-- sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li><a href="#">Account</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </div>
        <!-- page content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <a href="#" class="btn btn-success" id="sidebar-toggle">Toggle Menu</a>

                        <h1>Vitajte na stranke predmetu Tvorba informacnych systemov</h1>
                        <p>Pokracujte prihlasenim</p>

                        <!-- <div class="alert alert-danger fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Set your user name
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php // TODO: add to own js file ?>
    <!-- menu toggle script -->
    <script>
        $("#sidebar-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("menuDisplayed");
        });
    </script>
</body>
</html>
