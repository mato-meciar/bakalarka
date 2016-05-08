<?php
require_once dirname(dirname(dirname(__FILE__))).'/models/DBtables/User.php';
include_once dirname(dirname(dirname(__FILE__))).'/config.php';
global $client;
global $service;
global $redirect_uri;
global $authUrl;
if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
  exit;
}

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
} else {
  $authUrl = $client->createAuthUrl();
}

if (isset($authUrl)){ 
} else {
    $googleUser = $service->userinfo->get();
    $result = $GLOBALS['user']->checkGoogleUser($googleUser->id, $googleUser->email);
    header("Location: ".URL_BASE."/public/home");
}
?>


<h3>Prihlasenie</h3>

<div class="col-md-3 well clearfix" id="form"> 
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
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $result = $GLOBALS['user']->checkUser($_POST['email'], $_POST['password']);
//            $api = new API();
//            $result = $api->login(); //TODO remove, change to logging in in User class
            if ($result) {
                header("Location: ".URL_BASE."/public/home");
            } else {
                echo '<div class="alert alert-danger fade in" id="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     Nespravny e-mail a/alebo heslo!
                    </div>';
            }
        }
        ?>
    
   
    <!--<a href="<?= $authUrl; ?>"><img class="login-button" src="<?= URL_BASE.'/public/images/google-login-button-normal.png'?>"></a>-->
    <a class="panel-body btn btn-group-justified" href="<?= $authUrl; ?>" class="login-button" title="Google prihlasenie"><img src="<?= URL_BASE.'/public/images/google-login-button-normal.png'?>" onmouseover="this.src='<?= URL_BASE.'/public/images/google-login-button-hover.png'?>'" onmouseout="this.src='<?= URL_BASE.'/public/images/google-login-button-normal.png'?>'"></a>
    <a class="panel-footer btn btn-group-justified" href="<?= URL_BASE ?>/public/register">Vytvorit uzivatela</a>
</div>