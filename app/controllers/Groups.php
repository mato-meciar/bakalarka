<?php

    require_once dirname(dirname(__FILE__))."\\models\\DBtables\\Group.php";

    class Groups extends ViewController {
        
        public function __construct() {
            parent::__construct();
            $this->setNavLinkActive('group');
        }
        
        public function index() {
            if ($this->isLoggedUser()) {
                $this->view('group/index');
            }
        }
        
        public function edit() {
            if ($this->isLoggedUser()) {
                $group = new Group();
                $groupInfo = $group->getGroupByLeader($_SESSION['uid']);
                $this->view(array('groupInfo' => $groupInfo));
            }
        }
    }
