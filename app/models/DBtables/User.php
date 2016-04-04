<?php
class User {

    private $email;
    private $uid;
    private $role;

    public function __construct() {
        $email = null;
        $uid = null;
        $role = null;
    }

    public function existsUserUid($uid) {
        $mysql = new MySQL();
        $uid = $mysql->validate($uid);

        $sql = "SELECT EXISTS (SELECT * FROM pouzivatel WHERE id = '$uid') AS exist";
        return boolval($mysql->get_one_assoc($sql)['exist']);
    }
    
    public function existsUserEmail($email) {
        $mysql = new MySQL();
        $email = $mysql->validate($email);

        $sql = "SELECT EXISTS (SELECT * FROM pouzivatel WHERE email = '$email') AS exist";
        return boolval($mysql->get_one_assoc($sql)['exist']);
    }
    
    public function checkUser($email, $password) {
        $mysql = new MySQL();
        $email = $mysql->validate($email);
        $password = md5($mysql->validate($password));

        $sql = "SELECT id, email, rola FROM pouzivatel WHERE email = '$email' AND heslo = '$password'";
        $result = $mysql->get_one_assoc($sql);
        if ($result != null) {
            $this->email = $result['email'];
            $this->uid = $result['id'];
            $this->role = $result['rola'];
        }
        return boolval($result != null);
    }
    
    public function registerUser($email, $password, $role) {
        if (!$this->existsUserEmail($email)) {
            $mysql = new MySQL();
            $email = $mysql->validate($email);
            $password = $mysql->validate($password);
            
            $sql = "INSERT INTO pouzivatel (id, email, heslo, rola) VALUES (NULL, '$email', '$password', '$role')";
            $mysql->set($sql);
            return true;
        } else {
//            user with given email already exists
            echo "<script>alert('Uzivatel so zadanou e-mailovou adresou uz existuje!');</script>";
            return false;
        }
    }
    
    public function getUserUid($email) {
        
    }
    
    public function getUser() {
        return $this;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function getRole() {
        return $this->role;
    }
    
    public function getUid() {
        return $this->uid;
    }
    
    public function setUser($email, $role) {
        $this->email = $email;
        $this->role = $role;
    }
}
