<?php
    require_once dirname(dirname(__FILE__))."/models/DBtables/Project.php";
    require_once dirname(dirname(__FILE__))."/models/DBtables/Group.php";

    class Select extends ViewController {
        
        
        public function __construct() {
            parent::__construct();
            $this->setNavLinkActive('select');
        }
        
        public function index() {
            if (User::isLoggedUser() && User::hasLoggedUserAccess("uzivatel")) {
                $listProjects = Project::getApprovedProjectList();
                $groupInfo = Group::getGroupByLeader(User::getUid($_SESSION['user']));
                    $this->view(array('listProjects' => $listProjects, 'groupInfo' => $groupInfo));
            } else {
                self::redirect(URL_BASE . "/public/login");
            }
        }

    }
