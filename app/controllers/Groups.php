<?php

    require_once dirname(dirname(__FILE__))."/models/DBtables/Group.php";

    class Groups extends ViewController {
        
        public function __construct() {
            parent::__construct();
            $this->setNavLinkActive('group');
        }
        
        public function index() {
            if (User::isLoggedUser()) {
                $this->view('group/index');
            } else {
                header("Location: ".URL_BASE."/public/login");
            }
        }
        
        public function edit() {
            if (User::isLoggedUser()) {
                $group = new Group();
                $groupInfo = $group->getGroupByLeader(User::getUid());
                $this->view(array('groupInfo' => $groupInfo));
            }
        }
    }
