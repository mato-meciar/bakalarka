<?php

    class Home extends ViewController {
        
        public function __construct() {
            parent::__construct();
            $this->setNavLinkActive('home');
        }
        public function index($data = '') {
            if ($this->isLoggedUser()) {
                $this->View($data);
            }
        }
        
        public function logout() {
            if ($this->isLoggedUser()) {
                unset($_SESSION['user']);
                unset($_SESSION['role']);
                $this->userLogout();
                header("Location: ".URL_BASE."/public/login");
            }
        }

    }
