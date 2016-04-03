<?php

    class Login extends ViewController {
        
        public function __construct() {
            parent::__construct();
            $this->setNavLinkActive('login');
        }
        public function index() {
            $this->view('login/index');
        }

    }
