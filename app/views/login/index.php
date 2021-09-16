<div class="row">
	<div class="col-md-3 col-xs-0">
	</div>
	<div class="col-md-4 col-xs-4" style="padding-left: 0px">
		<h3>Prihlásenie</h3>
	</div>
</div>
<div class="row">
	<div class="col-md-3 col-xs-3">
	</div>
	<div class="col-md-6 col-xs-12 well" id="form">
		<form method="post" role="form" id="loginForm" data-toggle="validator">
			<?php
			require_once dirname(dirname(dirname(__FILE__))) . '/models/DBtables/User.php';
            require_once dirname(dirname(dirname(__FILE__))) . '/controllers/api.php';
            include_once dirname(dirname(dirname(__FILE__))) . '/config.php';
			global $client;
			global $service;
			global $redirect_uri;
			global $authUrl;
			if (isset($_GET['code'])) {
				$client->authenticate($_GET['code']);
				$_SESSION['access_token'] = $client->getAccessToken();
				self::redirect(filter_var($redirect_uri, FILTER_SANITIZE_URL));
			}

			if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
				$client->setAccessToken($_SESSION['access_token']);
			} else {
				$authUrl = $client->createAuthUrl();
			}

			if (isset($authUrl)) {
			} else {
				$googleUser = $service->userinfo->get();
				$result = User::checkGoogleUser($googleUser->id, $googleUser->email);
				$_SESSION['boli_pridelene'] = API::getAssignedSetting();
				$_SESSION['vytvaranie_skupin'] = API::getGroupCreationDate();
				self::redirect(URL_BASE . "/public/home");
			}

			if (isset($_POST['email']) && isset($_POST['password'])) {
				$result = User::checkUser($_POST['email'], $_POST['password']);
				if (!$result) {
					echo '<div class="alert alert-danger fade in" id="alert">
	                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	                     Nesprávny e-mail a/alebo heslo!
	                    </div>';
				} else {
					$_SESSION['boli_pridelene'] = API::getAssignedSetting();
					$_SESSION['vytvaranie_skupin'] = API::getGroupCreationDate();
					self::redirect(URL_BASE . "/public/home");
				}
			}
			?>
			<div class="form-group">
				<input type="email" id="email" class="form-control" data-error="Neplatná e-mailová adresa"
				       placeholder="Zadajte svoj e-mail" name="email" required
				       value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group">
				<input type="password" required="true" name="password" class="form-control" placeholder="Heslo">
			</div>
			<div class="form-group">
				<div class="row">
					<div class="text-center">
						<input type="submit" class="btn btn-primary" value="Prihlásiť">
					</div>
				</div>
				<div class="row">
					<div class="text-center">
						<a class="btn" href="<?= $authUrl; ?>" class="login-button" title="Google prihlásenie"><img
								src="<?= URL_BASE . '/public/images/google-login-button-normal.png' ?>"
								onmouseover="this.src='<?= URL_BASE . '/public/images/google-login-button-hover.png' ?>'"
								onmouseout="this.src='<?= URL_BASE . '/public/images/google-login-button-normal.png' ?>'"></a>
					</div>
				</div>
			</div>
		</form>
		<div class="row">
			<div class="text-center">
				<a href="<?= URL_BASE ?>/public/register">Vytvoriť užívateľa</a>
			</div>
		</div>
	</div>
</div>
</div>