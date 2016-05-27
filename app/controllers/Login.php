<?php

    class Login extends ViewController {
        
        public function __construct() {
            parent::__construct();
            $this->setNavLinkActive('login');
        }
        public function index() {
            if (User::isLoggedUser()) {
                self::redirect(URL_BASE . "/public/login");
            } else {
                $this->view('login/index');
            }
        }
    }
