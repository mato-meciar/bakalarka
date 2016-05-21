<?php

    class Login extends ViewController {
        
        public function __construct() {
            parent::__construct();
            $this->setNavLinkActive('login');
        }
        public function index() {
            if (User::isLoggedUser()) {
                header("Location: ".URL_BASE."/public/home");
            } else {
                $this->view('login/index');
            }
        }
    }
