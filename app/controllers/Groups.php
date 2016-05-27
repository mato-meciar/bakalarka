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
	            self::redirect(URL_BASE . "/public/login");
            }
        }
        
        public function edit() {
            if (User::isLoggedUser()) {
	            $groupInfo = Group::getGroupByLeader(User::getUid($_SESSION['user']));
                $this->view(array('groupInfo' => $groupInfo));
            }
        }

	    public function show() {
		    if (User::isLoggedUser()) {
			    $this->view('group/index');
		    } else {
			    self::redirect(URL_BASE . "/public/login");
		    }
	    }
    }
