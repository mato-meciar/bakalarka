<?php

require_once dirname(dirname(__FILE__))."/models/DBtables/User.php";
require_once dirname(dirname(__FILE__))."/models/DBtables/Project.php";

class API extends BaseController {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function login() {
//        $_POST = array('email' => '', 'password => '');
        if ($this->isLoggedUser()) {
        } else {
            $email = $_POST['email'];
            $password = $_POST['password'];
            if ($email != null && $password != null) {
                $user = $this->getLoggedUser();
                $result = $user->checkUser($email, $password);
                if ($result) {
                    $_SESSION['user'] = $user->getEmail();
                    $_SESSION['role'] = $user->getRole();
                    $_SESSION['uid'] = $user->getUid();
                    return true;
                } else {
                    $_POST['password'] = "";
                    return false;
                }
            } else {
                return false;
            }
        }
    }
    
    public function register() {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        if ($email != null && $password != null && $role != null) {
            $user = $this->getLoggedUser();
            $result = $this->getLoggedUser()->registerUser($email, md5($password), "NULL", $role);
            if ($result) {
                $user->setUser($email, $role, $user->getUserUid($user->getEmail()));
                $_SESSION['user'] = $user->getEmail();
                $_SESSION['role'] = $user->getRole();
                $_SESSION['uid'] = $user->getUserUid($user->getEmail());
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function logout() {
        if (!$this->isLoggedUser()) {
            return;
        } else {
            $this->userLogout();
        }
    }
    
    public function createProject() {
        $name = $_POST['name'];
        $details = $_POST['details'];
        $creator_id = $_SESSION['uid'];
        $domain = $_POST['domain'];
        $platform = $_POST['platform'];
        $technologies = $_POST['technologies'];
        $year = CURRENT_SCHOOL_YEAR;
        if (($name != null) && ($details != null) && ($creator_id != null) && ($domain != null) && ($platform != null) && ($technologies != null) && ($year != null)) {
            $project = new Project();
            $result = $project->addProject($name, $details, $creator_id, $domain, $platform, $technologies, $year);
            if ($result) {
                unset($_POST);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function updateProject($projectID) {
        $name = $_POST['name'];
        $details = $_POST['details'];
        $creator_id = $_SESSION['uid'];
        $domain = $_POST['domain'];
        $platform = $_POST['platform'];
        $technologies = $_POST['technologies'];
        $year = CURRENT_SCHOOL_YEAR;
        $project = new Project();
        $result = $project->updateProject($projectID, $name, $details, $domain, $platform, $technologies);
        if ($result) {
            unset($_POST);
            return true;
        } else {
            return false;
        }
    }
    
    public function createGroup() {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $leader_id = $_SESSION['uid'];
        $skills = $_POST['skills'];
        $members = $_POST['members'];
        if (($name != null) && ($email != null) && ($leader_id != null) && ($skills != null) && ($members != null)) {
            $group = new Group();
            $result = $group->addGroup($name, $email, $leader_id, $skills, $members);
            if ($result) {
                unset($_POST);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function updateGroup($group_id) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $skills = $_POST['skills'];
        $members = $_POST['members'];
        $group = new Group();
        $result = $group->updategroup($group_id, $name, $email, $skills, $members);
        if ($result) {
            unset($_POST);
            return true;
        } else {
            return false;
        }
    }
    
    public function projectPreferences($preferences, $groupID) {
        $prefString = "";
        if ($preferences != "none") {
            foreach ($preferences as $key => $value) {
                echo "key: $key, value: $value\n";
                $prefString = $prefString."$key:$value;";
            }
        }
        $group = new Group();
        $result = $group->updatePreferences($prefString, $groupID);
        return true;
    }
}
