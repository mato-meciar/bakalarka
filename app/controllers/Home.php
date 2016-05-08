<?php
    class Home extends ViewController {
        
        public function __construct() {
            parent::__construct();
            $this->setNavLinkActive('home');
        }
        public function index($data = '') {
            if ($GLOBALS['user']->isLoggedUser()) {
                $this->View($data);
            } else {
                $this->showLogin();
            }
        }
        
        public function logout() {
            if ($GLOBALS['user']->isLoggedUser()) {
                $this->userLogout();
                header("Location: ".URL_BASE."/public/login");
            }
        }

    }
