<?php

class Settings extends ViewController {
	public function __construct() {
		parent::__construct();
		$this->setNavLinkActive('settings');
	}

	public function index() {
		if (User::isLoggedUser() && User::hasLoggedUserAccess("admin")) {
			$this->view(array());
		} else {
			self::redirect(URL_BASE . "/public/login");
		}
	}
}
