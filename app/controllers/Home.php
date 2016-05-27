<?php
    class Home extends ViewController {
        
        public function __construct() {
            parent::__construct();
            $this->setNavLinkActive('home');
        }
        public function index($data = '') {
            if (User::isLoggedUser()) {
                $this->View($data);
            } else {
                $this->showLogin();
            }
        }
        
        public function logout() {
            if (User::isLoggedUser()) {
                User::logout();
                self::redirect(URL_BASE . "/public/login");
            }
        }

    }
