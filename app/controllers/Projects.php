<?php

    require_once dirname(dirname(__FILE__))."/models/DBtables/Project.php";

    class Projects extends ViewController {
        
        public function __construct() {
            parent::__construct();
            $this->setNavLinkActive('projects');
        }
        
        public function index($own = 'false') {
            if ($GLOBALS['user']->isLoggedUser()) {
                $project = new Project();
                if ($own == 'true') {
                    $listProjects = $project->getProjectList($_SESSION['uid']);
                    $this->view(array('listProjects' => $listProjects));
                } else {
                    if ($GLOBALS['user']->hasLoggedUserAccess("uzivatel")) {
                        $listProjects = $project->getApprovedProjectList();
                        $this->view(array('listProjects' => $listProjects));
                    }
                    $listProjects = $project->getProjectList();
                    $this->view(array('listProjects' => $listProjects));
                }
            } else {
                header("Location: ".URL_BASE."/public/login");
            }
        }
        
        public function detail($projectID) {
            if ($GLOBALS['user']->isLoggedUser()) {
                $project = new Project();
                $projectInfo = $project->getProject($projectID);
                $this->view(array('projectInfo' => $projectInfo));
            } else {
                header("Location: ".URL_BASE."/public/login");
            }
        }
        
        public function edit($projectID) {
            if ($GLOBALS['user']->isLoggedUser()) {
                $project = new Project();
                $projectInfo = $project->getProject($projectID);
                $this->view(array('projectInfo' => $projectInfo));
            } else {
                header("Location: ".URL_BASE."/public/login");
            }
        }
        
        public function approval() {
            if ($GLOBALS['user']->isLoggedUser()) {
                $project = new Project();
                $listProjects = $project->getUnapprovedProjectList();
                $this->view(array('listProjects' => $listProjects));
            } else {
                header("Location: ".URL_BASE."/public/login");
            }
        }
        
        public function approve($projectID) {
            if ($GLOBALS['user']->isLoggedUser()) {
                $this->view(array('projectID' => $projectID));
                header("Location: ".URL_BASE."/public/approval");
            } else {
                header("Location: ".URL_BASE."/public/login");
            }
        }

    }
