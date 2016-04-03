<?php

    class Create_project extends ViewController {
        
        public function __construct() {
            parent::__construct();
            $this->setNavLinkActive('create_project');
        }
        
        public function index() {
            $this->view('create_project/index');
        }

    }
