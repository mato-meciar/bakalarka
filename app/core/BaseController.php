<?php

require_once dirname(dirname(__FILE__))."/models/MySQL.php";
require_once dirname(dirname(__FILE__))."/models/DBtables/Access.php";
require_once dirname(dirname(__FILE__))."/models/DBtables/User.php";

class BaseController {
    
    private $myUser;
    
    public function __construct() {
        $this->myUser = null;
        if (isset($_SESSION['user']) && isset($_SESSION['role'])) {
            $this->myUser = new User();
            $this->myUser->setUser($_SESSION['user'], $_SESSION['role']);
            
            $accessManagement = new Access();
//            $this->myUser['role'] = $accessManagement->getAccess($this->myUser['uid']['0']);
        }
    }
    
    protected function userLogout() {
        $this->myUser = null;
    }
    
    protected function isLoggedUser() {
        return $this->myUser != null;
    }
    
    protected function getLoggedUser() {
        return $this->myUser;
    }
    
    protected function getLoggedUserUID() {
        return $this->myUser->getUid();
    }
    
    protected function hasLoggedUserAccess($role) {
        return $this->myUser->getRole() == $role;
    }

    public function model($model) {
        require_once dirname(dirname(__FILE__)).'/models/' . $model . '.php';
        return new $model();
    }
    
    protected function getUrl($url) {
        $url = URL_BASE . '/' . $url;
        if (substr($url, -1) != '/') {
            $url = $url . '/';
        }
        return $url;
    }
}
