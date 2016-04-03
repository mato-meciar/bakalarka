<h3>Prihlasenie</h3>
<div class="col-md-5 well">
    <form method="post" role="form" id="loginForm" data-toggle="validator">
        <div class="form-group">
            <input type="email" id="email" class="form-control" data-error="Neplatna e-mailova adresa" placeholder="Zadajte svoj e-mail" name="email" required>
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
    require_once dirname(dirname(dirname(__FILE__)))."\\controllers\\API.php";

        if (isset($_POST['email']) && isset($_POST['password'])) {
            $api = new API();
            $result = $api->login();
            if ($result) {
                header("Location: ".URL_BASE."/public/home");
            }
        }
    ?>
    <a href="<?= URL_BASE ?>/public/register">Vytvorit uzivatela</a>
</div>