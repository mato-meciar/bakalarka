<?php

    class Register extends ViewController {
        
        public function __construct() {
            parent::__construct();
            $this->setNavLinkActive('register');
        }
        public function index() {
            $this->view('register/index');
        }
        
        public function register($email, $password) {
            
        }

    }
