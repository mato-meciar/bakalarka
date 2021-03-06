<?php

    class Create_project extends ViewController {
        
        public function __construct() {
            parent::__construct();
            $this->setNavLinkActive('create_project');
        }
        
        public function index() {
            if (User::isLoggedUser()) {
                $this->view('create_project/index');
            } else {
                self::redirect(URL_BASE . "/public/login");
            }
        }

    }
