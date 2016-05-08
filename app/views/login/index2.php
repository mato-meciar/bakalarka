<!--<script src="https://apis.google.com/js/platform.js" async defer></script>-->
<!--<meta name="google-signin-client_id" content="29418959227-cea5c0a516p6nr0ef8n41mh51c4bm05h.apps.googleusercontent.com">-->

<h3>Prihlasenie</h3>

<div class="col-md-5 well clearfix" id="form">
    <?php
        if (isset($_POST['email'])) {
            echo '<div class="alert alert-danger fade in" id="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     Nespravny e-mail a/alebo heslo!
                    </div>';
        }
    ?>
    
    <form method="post" role="form" id="loginForm" data-toggle="validator">
        <div class="form-group">
            <input type="email" id="email" class="form-control" data-error="Neplatna e-mailova adresa" placeholder="Zadajte svoj e-mail" name="email" required value="<?php if (isset($_POST['email'])) echo $_POST['email'];?>">
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
            <input type="password" required="true" name="password" class="form-control" placeholder="Heslo">
        </div>
        <div class="form-group">
            <div>
                <input type="submit" class="btn btn-primary btn-block" value="Prihlasit">
            </div>
        </div>
    </form>

    <?php
    require_once dirname(dirname(dirname(__FILE__)))."/controllers/API.php";

        if (isset($_POST['email']) && isset($_POST['password'])) {
            $api = new API();
            $result = $api->login(); //TODO remove, change to logging in in User class
            if ($result) {
                header("Location: ".URL_BASE."/public/home");
            } else {
            }
        }
    ?>
    <a class="pull-right" href="#">Google sign-in</a>
    <a href="<?= URL_BASE ?>/public/register">Vytvorit uzivatela</a>
</div>
