<h3>Registracia</h3>
<div class="col-md-5 well">
    <form method="post" role="form" id="registerForm" data-toggle="validator">
        <div class="form-group">
            Ste zadavatel?  <div class="radio"><label><input type="radio" name="role" value="zadavatel">ano</label></div>
            <div class="radio"><label><input type="radio" name="role" value="uzivatel" checked="checked">nie</label></div>
        </div>
        <div class="form-group">
            <input type="email" id="email" class="form-control" data-error="Neplatna e-mailova adresa" placeholder="Zadajte svoj e-mail" name="email" required>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
            <input type="password" required data-minlength="6" class="form-control" id="password" placeholder="Heslo" name="password">
            <div class="help-block">Najmenej 6 znakov</div>
        </div>
        <div class="form-group">
            <input type="password" required class="form-control" id="passwordConfirm" data-match="#password" data-match-error="Hesla sa nezhoduju!" placeholder="Potvrdte heslo" name="passwordConfirm">
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
            <div>
                <input type="submit" class="btn btn-primary btn-block" data-target="#myModal" value="Registrovat">
            </div>
        </div>
    </form>
    
    <?php
    require_once dirname(dirname(dirname(__FILE__)))."/controllers/API.php";

        if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])) {
            $api = new API();
            $api->register();
            $result = $api->login();
            if ($result) {
                unset($_POST);
                header("Location: ".URL_BASE."/public/home");
            }
        }
    ?>
    
</div>
