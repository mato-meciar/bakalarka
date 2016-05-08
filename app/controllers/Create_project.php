<?php

    class Create_project extends ViewController {
        
        public function __construct() {
            parent::__construct();
            $this->setNavLinkActive('create_project');
        }
        
        public function index() {
            if ($GLOBALS['user']->isLoggedUser()) {
                $this->view('create_project/index');
            } else {
                header("Location: ".URL_BASE."/public/login");
            }
        }

    }
