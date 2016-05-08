<?php

require_once dirname(dirname(__FILE__))."/models/MySQL.php";
require_once dirname(dirname(__FILE__))."/models/DBtables/Access.php";
require_once dirname(dirname(__FILE__))."/models/DBtables/User.php";
include_once dirname(dirname(__FILE__)).'/config.php';

if (!isset($GLOBALS['user'])) {
    $GLOBALS['user'] = new User();
} 

class BaseController {
    
    
    public function __construct() {
//        if (isset($_SESSION['user']) && isset($_SESSION['role'])) {
//            $this->myUser->setUser($_SESSION['user'], $_SESSION['role']);
//            
//            $accessManagement = new Access();
//            $this->myUser['role'] = $accessManagement->getAccess($this->myUser['uid']['0']);
//        }
//        var_dump($_SESSION);
    }
    
    protected function userLogout() {
        global $client;
        unset($_SESSION['token']);
        $GLOBALS['user'] = new User();
        unset($_SESSION['email']);
        unset($_SESSION['uid']);
        unset($_SESSION['role']);
        $client->revokeToken();
        session_destroy();
    }
    
//    protected function isLoggedUser() {
//        return $GLOBALS['user']->getEmail() != null;
//    }
//    
//    protected function getLoggedUser() {
//        return $GLOBALS['user'];
//    }
//    
//    protected function getLoggedUserUID() {
//        return $GLOBALS['user']->getUid();
//    }
//    
//    protected function hasLoggedUserAccess($role) {
//        return $GLOBALS['user']->getRole() == $role;
//    }

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
