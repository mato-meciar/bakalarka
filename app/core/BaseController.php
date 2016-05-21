<?php

require_once dirname(dirname(__FILE__))."/models/MySQL.php";
require_once dirname(dirname(__FILE__))."/models/DBtables/Access.php";
require_once dirname(dirname(__FILE__))."/models/DBtables/User.php";
include_once dirname(dirname(__FILE__)).'/config.php';

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
        unset($_SESSION['email']);
        unset($_SESSION['uid']);
        unset($_SESSION['role']);
        $client->revokeToken();
        session_destroy();
    }
    
    protected function isLoggedUser() {
        return (isset($_SESSION['email']) && isset($_SESSION['uid']) && isset($_SESSION['role']));
    }
    
    protected function getLoggedUser() {
        return $_SESSION['email'];
    }
    
    protected function getLoggedUserUID() {
        return $_SESSION['uid'];
    }
    
    protected function hasLoggedUserAccess($role) {
        return $_SESSION['role'] == $role;
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
