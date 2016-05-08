<?php
    require_once dirname(dirname(__FILE__))."/models/DBtables/Project.php";
    require_once dirname(dirname(__FILE__))."/models/DBtables/Group.php";


    class Select extends ViewController {
        
        
        public function __construct() {
            parent::__construct();
            $this->setNavLinkActive('select');
        }
        
        public function index() {
            if ($GLOBALS['user']->isLoggedUser() && $GLOBALS['user']->hasLoggedUserAccess("uzivatel")) {
                $project = new Project();
                    $listProjects = $project->getApprovedProjectList();
                    $group = new Group();
                    $groupInfo = $group->getGroupByLeader($GLOBALS['user']->getUid());
                    $this->view(array('listProjects' => $listProjects, 'groupInfo' => $groupInfo));
            } else {
                header("Location: ".URL_BASE."/public/login");
            }
        }

    }
