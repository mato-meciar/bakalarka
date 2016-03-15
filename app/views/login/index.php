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
                <a href="./home" class="navbar-brand">Tvorba informacnych systemov</a>
            </div>
        </div>
    </nav>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1 col-md-offset-5">
                <div class="container col-centered">
                    <div class="g-signin2" data-onsuccess="onSignIn" id="googleLogin"></div>
                    <script>

                        function onSignIn(googleUser) {
                            // Useful data for your client-side scripts:
                            var profile = googleUser.getBasicProfile();
                            console.log("ID: " + profile.getId()); // Don't send this directly to your server!
                            console.log("Name: " + profile.getName());
                            console.log("Image URL: " + profile.getImageUrl());
                            console.log("Email: " + profile.getEmail());

                            // The ID token you need to pass to your backend:
                            var id_token = googleUser.getAuthResponse().id_token;
                            console.log("ID Token: " + id_token);
                        };
                    </script>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1 col-md-offset-5">
                <div class="container col-centered">
                    <button type="button" class="btn btn-success navbar-btn" data-toggle="modal" data-target="#popupWindow-register" id="register-btn">Registracia</button>
                    <div class="modal fade" id="popupWindow-register">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!--header-->                                    
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4>Registracia</h4>
                                </div>
                                <!--body-->
                                <div class="modal-body">
                                    <form role="form">
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="E-mail">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Heslo" id="password">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Znova zadajte heslo" id="password-retype">
                                        </div>
                                    </form>
                                </div>
                                <!--button-->
                                <div class="modal-foter">
                                    <button class="btn btn-primary btn-block">Registrovat</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1 col-md-offset-5">
                <div class="container col-centered">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#popupWindow-login" id="login-btn">Prihlasenie</button>
                    <div class="modal fade" id="popupWindow-login">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!--header-->                                    
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4>Prihlasenie</h4>                              
                                </div>
                                <!--body-->
                                <div class="modal-body">
                                    <form role="form">
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="E-mail">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Heslo">
                                        </div>
                                    </form>
                                    <a href="./reset">Zabudnute heslo</a>
                                </div>
                                <!--button-->
                                <div class="modal-foter">
                                    <button class="btn btn-primary btn-block">Prihlasit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
