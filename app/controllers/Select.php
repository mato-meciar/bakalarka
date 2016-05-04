<?php
    require_once dirname(dirname(__FILE__))."/models/DBtables/Project.php";
    require_once dirname(dirname(__FILE__))."/models/DBtables/Group.php";


    class Select extends ViewController {
        
        public function __construct() {
            parent::__construct();
            $this->setNavLinkActive('select');
        }
        
        public function index() {
            if ($this->isLoggedUser() && $this->hasLoggedUserAccess("uzivatel")) {
                $project = new Project();
                    $listProjects = $project->getApprovedProjectList();
                    $group = new Group();
                    $groupInfo = $group->getGroupByLeader($_SESSION['uid']);
                    $this->view(array('listProjects' => $listProjects, 'groupInfo' => $groupInfo));
            } else {
                header("Location: ".URL_BASE."/public/login");
            }
        }

    }
