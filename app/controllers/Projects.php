<?php

    require_once dirname(dirname(__FILE__))."/models/DBtables/Project.php";

    class Projects extends ViewController {
        
        public function __construct() {
            parent::__construct();
            $this->setNavLinkActive('projects');
        }
        
        public function index($own = 'false') {
            $project = new Project();
            if (User::isLoggedUser()) {
                if ($own == 'true') {
                    $listProjects = $project->getProjectList(User::getUid());
                    $this->view(array('listProjects' => $listProjects));
                } else {
                    if (User::hasLoggedUserAccess("uzivatel")) {
                        $listProjects = $project->getApprovedProjectList();
                        $this->view(array('listProjects' => $listProjects));
                    }
                    $listProjects = $project->getProjectList();
                    $this->view(array('listProjects' => $listProjects));
                }
            } else {
                $listProjects = $project->getApprovedProjectList();
                $this->view(array('listProjects' => $listProjects));
            }
        }
        
        public function detail($projectID) {
            $project = new Project();
            $projectInfo = $project->getProject($projectID);
            $this->view(array('projectInfo' => $projectInfo));
        }
        
        public function edit($projectID) {
            if (User::isLoggedUser()) {
                $project = new Project();
                $projectInfo = $project->getProject($projectID);
                $this->view(array('projectInfo' => $projectInfo));
            } else {
                header("Location: ".URL_BASE."/public/login");
            }
        }
        
        public function approval() {
            if (User::isLoggedUser()) {
                $project = new Project();
                $listProjects = $project->getUnapprovedProjectList();
                $this->view(array('listProjects' => $listProjects));
            } else {
                header("Location: ".URL_BASE."/public/login");
            }
        }
        
        public function approve($projectID) {
            if (User::isLoggedUser()) {
                $this->view(array('projectID' => $projectID));
                // header("Location: ".URL_BASE."/public/projects/approval");
            } else {
                header("Location: ".URL_BASE."/public/login");
            }
        }

    }
