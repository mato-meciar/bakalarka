<?php

class MySQL {

    private $conn = null;

    public function __construct() {
        $this->conn = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_NAME);
        mysqli_set_charset($this->conn, "utf8");
        mysqli_query($this->conn, 'SET group_concat_max_len = 512');
    }

    public function __destruct() {
        if ($this->conn != null) {
            mysqli_close($this->conn);
            $this->conn = null;
        }
    }

    public function get_all($sql) {
        $result_list = array();
        try {
            $result = mysqli_query($this->conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $result_list[] = $row;
            }
        } catch (Exception $e) {
            return false;
        }
        return $result_list;
    }

    public function get_all_assoc($sql) {
        $result_list = array();
        try {
            $result = mysqli_query($this->conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $result_list[] = $row;
            }
        } catch (Exception $e) {
            return false;
        }
        return $result_list;
    }

    public function get_one($sql) {
        try {
            $result = mysqli_query($this->conn, $sql);
            return mysqli_fetch_array($result);
        } catch (Exception $e) {
            return false;
        }
    }

    public function get_one_assoc($sql) {
        try {
            $result = mysqli_query($this->conn, $sql);
            return mysqli_fetch_assoc($result);
        } catch (Exception $e) {
            return false;
        }
    }

    public function set($sql) {
        try {
            return mysqli_query($this->conn, $sql);
        } catch (Exception $e) {
            return false;
        }
    }

    public function validate($string) {
        $string = htmlspecialchars($string);
        return mysqli_real_escape_string($this->conn, $string);
    }
    
    public function loginDB($email, $password) {
        
    }

}
