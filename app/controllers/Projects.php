<?php

    require_once dirname(dirname(__FILE__))."/models/DBtables/Project.php";
require_once dirname(dirname(__FILE__)) . "/controllers/API.php";

    class Projects extends ViewController {
        
        public function __construct() {
            parent::__construct();
            $this->setNavLinkActive('projects');
        }
        
        public function index($own = 'false') {
            if (User::isLoggedUser()) {
                if ($own == 'true') {
	                $listProjects = Project::getProjectList(User::getUid($_SESSION['user']));
                    $this->view(array('listProjects' => $listProjects));
                } else {
                    if (User::hasLoggedUserAccess("uzivatel")) {
	                    if (intval($_SESSION['boli_pridelene']) == 1) {
		                    $listProjects = Project::getAssignedProjectList();
	                    } else {
		                    $listProjects = Project::getApprovedProjectList();
	                    }
                    } elseif (User::hasLoggedUserAccess("zadavatel") || User::hasLoggedUserAccess("admin")) {
	                    $listProjects = Project::getApprovedProjectList();
                    }
                }
            } else {
	            if (intval(API::getAssignedSetting()) == 1) {
		            $listProjects = Project::getAssignedProjectList();
	            } else {
		            $listProjects = Project::getApprovedProjectList();
	            }
            }
	        $this->view(array('listProjects' => $listProjects));
        }

	    public function detail($projectId) {
		    $projectInfo = Project::getProject($projectId);
            $this->view(array('projectInfo' => $projectInfo));
        }

	    public function edit($projectId) {
            if (User::isLoggedUser()) {
	            $projectInfo = Project::getProject($projectId);
                $this->view(array('projectInfo' => $projectInfo));
            } else {
	            self::redirect(URL_BASE . "/public/login");
            }
        }
        
        public function approval() {
            if (User::isLoggedUser()) {
	            $listProjects = Project::getUnapprovedProjectList();
                $this->view(array('listProjects' => $listProjects));
            } else {
	            self::redirect(URL_BASE . "/public/login");
            }
        }

	    public function approve($projectId) {
            if (User::isLoggedUser()) {
	            $this->view(array('projectId' => $projectId));
                // header("Location: ".URL_BASE."/public/projects/approval");
            } else {
	            self::redirect(URL_BASE . "/public/login");
            }
        }

	    public function delete($projectId) {
		    if (User::isLoggedUser() && User::hasLoggedUserAccess("admin")) {
			    $this->view(array('projectId' => $projectId));
		    } else {
			    self::redirect(URL_BASE . "/public/login");
		    }
	    }
    }
