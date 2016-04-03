<?php

require_once dirname(dirname(__FILE__))."\\models\\DBtables\\User.php";

class API extends BaseController {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function login() {
//        $_POST = array('email' => '', 'password => '');
        if ($this->isLoggedUser()) {
            echo 'OK';
        } else {
            $email = $_POST['email'];
            $password = $_POST['password'];
            if ($email != null && $password != null) {
                $user = new User();
                $result = $user->checkUser($email, $password);
                if ($result) {
                    $_SESSION['user'] = $user->getEmail();
                    $_SESSION['role'] = $user->getRole();
                    return true;
                } else {
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
            $user = new User();
            $result = $user->registerUser($email, md5($password), $role);
            if ($result) {
                $_SESSION['user'] = $user->getEmail();
                $_SESSION['role'] = $user->getRole();
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
            unset($_SESSION['user']);
            unset($_SESSION['role']);
        }
    }
}
