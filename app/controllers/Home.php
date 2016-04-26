<?php

    class Home extends ViewController {
        
        public function __construct() {
            parent::__construct();
            $this->setNavLinkActive('home');
        }
        public function index($data = '') {
            if ($this->isLoggedUser()) {
                $this->View($data);
            } else {
                $this->showLogin();
            }
        }
        
        public function logout() {
            if ($this->isLoggedUser()) {
                session_start();
                session_destroy();
                $this->userLogout();
                header("Location: ".URL_BASE."/public/login");
            }
        }

    }
