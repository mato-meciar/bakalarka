<?php

class Selection extends ViewController {


	public function __construct() {
		parent::__construct();
		$this->setNavLinkActive('selection');
	}

	public function index() {
		if (User::isLoggedUser() && User::hasLoggedUserAccess("admin")) {
			$this->view();
		} else {
			self::redirect(URL_BASE . "/public/login");
		}
	}

	public function edit() {
		if (User::isLoggedUser() && User::hasLoggedUserAccess("admin")) {
			if (isset($_SESSION['boli_pridelene']) && !empty($_SESSION['boli_pridelene'])) {
				self::redirect(URL_BASE . "/public/selection");
			} else {
				$this->view();
			}
			$this->view();
		} else {
			self::redirect(URL_BASE . "/public/login");
		}
	}

	public function assign() {
		if (User::isLoggedUser() && User::hasLoggedUserAccess("admin")) {
			if (isset($_SESSION['boli_pridelene']) && !empty($_SESSION['boli_pridelene'])) {
				self::redirect(URL_BASE . "/public/selection");
			} else {
				$this->view();
			}
		} else {
			self::redirect(URL_BASE . "/public/login");
		}
	}

}
