<?php
class User {

    public function __construct() {
    }

    public static function existsUserUid($uid) {
        $mysql = new MySQL();
        $uid = $mysql->validate($uid);

        $sql = "SELECT EXISTS (SELECT * FROM pouzivatel WHERE id = '$uid') AS exist";
        return boolval($mysql->get_one_assoc($sql)['exist']);
    }
    
    public static function checkUser($email, $password) {
        $mysql = new MySQL();
        $email = $mysql->validate($email);
        $password = md5($mysql->validate($password));

        $sql = "SELECT id, email, rola FROM pouzivatel WHERE email = '$email' AND heslo = '$password'";
        $result = $mysql->get_one_assoc($sql);
        if ($result != null) {
            User::setUser($result['email'], $result['rola'], $result['id']);
        }
        return boolval($result != null);
    }

    public static function setUser($email, $role, $uid) {
        $_SESSION['user'] = $email;
        $_SESSION['role'] = $role;
        $_SESSION['uid'] = $uid;
    }
    
    public static function checkGoogleUser($google_id, $email) {
        $newUser = false;
        $mysql = new MySQL();
        $google_id = $mysql->validate($google_id);
        $email = $mysql->validate($email);
        
        $sql = "SELECT * FROM pouzivatel WHERE google_id = '".$google_id."' AND email = '".$email."'";
        $result = $mysql->get_one_assoc($sql);
        if ($result == null) {
            self::registerUser($email, NULL, $google_id, "uzivatel");
            $newUser = true;
        } 
        $result = $mysql->get_one_assoc($sql);
        if ($result != null) {
            User::setUser($result['email'], $result['rola'], $result['id']);
        }
        return $newUser;
    }
 
    public static function registerUser($email, $password, $google_id, $role) {
        if (!User::existsUserEmail($email)) {
            $mysql = new MySQL();
            $email = $mysql->validate($email);
            $password = $mysql->validate($password);
            $password = md5($password);

            $google_id = $mysql->validate($google_id);
            $role = $mysql->validate($role);
            $sql = "INSERT INTO pouzivatel (id, google_id, email, heslo, rola) VALUES (NULL, '$google_id', '$email', '$password', '$role')";
            $mysql->set($sql);
            User::setUser($email, $role, User::getUid($email));
            return true;
        } else {
//            user with given email already exists
            echo "<script>alert('Uzivatel so zadanou e-mailovou adresou uz existuje!');</script>";
            return false;
        }
    }

    public static function existsUserEmail($email) {
        $mysql = new MySQL();
        $email = $mysql->validate($email);

        $sql = "SELECT EXISTS (SELECT * FROM pouzivatel WHERE email = '$email') AS exist";
        return boolval($mysql->get_one_assoc($sql)['exist']);
    }

    public static function getUid($email) {
        $mysql = new MySQL();

        $sql = "SELECT id FROM pouzivatel WHERE email = '$email'";
        $result = $mysql->get_one($sql);
        if ($result) {
            return $result['id'];
        }
    }

    public static function getRole($email) {
        $mysql = new MySQL();

        $sql = "SELECT rola FROM pouzivatel WHERE email = '$email'";
        $result = $mysql->get_one($sql);
        if ($result) {
            return $result['rola'];
        }
    }
    
    public static function isLoggedUser() {
        return isset($_SESSION['user']);
    }
    public static function hasLoggedUserAccess($access) {
        if (isset($_SESSION['role'])) {
            return $_SESSION['role'] == $access;
        }
        return false;
    }

    public static function logout() {
        global $client;
        unset($_SESSION['token']);
        unset($_SESSION['email']);
        unset($_SESSION['uid']);
        unset($_SESSION['role']);
        unset($_SESSION['boli_pridelene']);
        unset($_SESSION['assignment']);
        unset($_SESSION['elapsed']);
        unset($_SESSION['user']);
        unset($_SESSION['vytvaranie_skupin']);
        unset($_POST);
        $client->revokeToken();
        session_destroy();
    }
}
