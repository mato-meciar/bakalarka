<div class="container-fluid">
<h3>Registracia</h3>
<div class="span12 well">
    <form method="post" role="form" id="registerForm" data-toggle="validator">
        <div class="form-group">
            Ste zadavatel?  <div class="radio"><input type="radio" id="role-1" name="role" value="zadavatel"><label for="role-1">ano</label></div>
            <div class="radio"><input type="radio" id="role-2" name="role" value="uzivatel" checked><label for="role-2">nie</label></div>
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
    if (!User::isLoggedUser()) {
        if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])) {
            $result = User::registerUser($_POST['email'], $_POST['password'], "NULL", $_POST['role']);
            if ($result) {
                unset($_POST);
                header("Location: ".URL_BASE."/public/home");
            }
        }
}

    ?>
</div>    
</div>
