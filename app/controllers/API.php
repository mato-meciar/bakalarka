<?php

require_once dirname(dirname(__FILE__))."/models/DBtables/User.php";
require_once dirname(dirname(__FILE__))."/models/DBtables/Project.php";

class API extends BaseController {
    
    public function __construct() {
        parent::__construct();
    }

	public static function login() {
//        $_POST = array('email' => '', 'password => '');
		if (API::isLoggedUser()) {
        } else {
            $email = $_POST['email'];
            $password = $_POST['password'];
            if ($email != null && $password != null) {
	            $result = User::checkUser($email, $password);
                if ($result) {
	                User::setUser($email, User::getRole($email), User::getUid($email));
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

	public static function register() {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        if ($email != null && $password != null && $role != null) {
	        $result = User::registerUser($email, $password, "NULL", $role);
            if ($result) {
	            User::setUser($email, $role, User::getUid($email));
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

	public static function createProject() {
        $name = $_POST['name'];
		$email = $_POST['email'];
        $details = $_POST['details'];
        $creator_id = $_SESSION['uid'];
		$domain = mb_strtolower(self::remove_accents($_POST['domain']));
		$platform = mb_strtolower(self::remove_accents($_POST['platform']));
		$technologies = mb_strtolower(self::remove_accents($_POST['technologies']));
        $year = CURRENT_SCHOOL_YEAR;
		if (($name != null) && ($details != null) && ($creator_id != null) && ($year != null)) {
			$result = Project::addProject($name, $email, $details, $creator_id, $domain, $platform, $technologies, $year);
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

	public static function writeDate($datum) {
		$mysql = new MySQL();
		$date = new DateTime();
		$date->setTimezone(new DateTimeZone("Europe/Bratislava"));
		$date = $date->modify($datum);
		$date = $date->format("Y-m-d H:i:s");
		$sql = "UPDATE nastavenia
                SET vytvaranie_skupin = '$date' WHERE 1";
		$result = $mysql->set($sql);
		return true;
	}

	public static function setAssignedSetting() {
		$mysql = new MySQL();

		$sql = 'UPDATE nastavenia
                SET boli_pridelene = 1 WHERE 1';
		return $mysql->set($sql);
	}

	public static function getGroupCreationDate($time = false) {
		$mysql = new MySQL();
		$sql = "SELECT n.vytvaranie_skupin
				FROM nastavenia n WHERE 1";
		$result = $mysql->set($sql);
		$date = new DateTime();
		$date->setTimezone(new DateTimeZone("Europe/Bratislava"));
		$date = $date->modify($result->fetch_row()[0]);
		if ($time) {
			return $date->format("Y-m-d H:i:s");
		}
		return $date->format("d.m.Y");
	}

	public static function getAssignedSetting() {
		$mysql = new MySQL();
		$sql = "SELECT n.boli_pridelene
				FROM nastavenia n WHERE 1";
		$result = $mysql->set($sql);

		return $result->fetch_row()[0];
	}

	public static function updateProject($project_id) {
        $name = $_POST['name'];
        $details = $_POST['details'];
		$email = $_POST['email'];
        $creator_id = $_SESSION['uid'];
		if (isset($_POST['important'])) {
			$important = $_POST['important'];
		}
		$domain = mb_strtolower(self::remove_accents($_POST['domain']));
		$platform = mb_strtolower(self::remove_accents($_POST['platform']));
		$technologies = mb_strtolower(self::remove_accents($_POST['technologies']));
        $year = CURRENT_SCHOOL_YEAR;
		$result = Project::updateProject($project_id, $name, $email, $details, $domain, $platform, $technologies, $important);
        if ($result) {
            unset($_POST);
            return true;
        } else {
            return false;
        }
    }

	public static function createGroup() {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $leader_id = $_SESSION['uid'];
		$skills = mb_strtolower($_POST['skills']);
		$members = mb_strtolower($_POST['members']);
        if (($name != null) && ($email != null) && ($leader_id != null) && ($skills != null) && ($members != null)) {
	        $result = Group::addGroup($name, $email, $leader_id, $skills, $members);
            if ($result) {
                unset($_POST);
	            self::redirect(URL_BASE . "/public/groups");
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

	public static function updateGroup($group_id) {
        $name = $_POST['name'];
        $email = $_POST['email'];
		$skills = mb_strtolower($_POST['skills']);
		$members = mb_strtolower($_POST['members']);
		$result = Group::updateGroup($group_id, $name, $email, $skills, $members);
        if ($result) {
            unset($_POST);
            return true;
        } else {
            return false;
        }
    }

	public static function projectPreferences($preferences, $groupID) {
        $prefString = "";
        if ($preferences != "none") {
            foreach ($preferences as $key => $value) {
                echo "key: $key, value: $value\n";
                $prefString = $prefString."$key:$value;";
            }
        }
		$result = Group::updatePreferences($prefString, $groupID);
        return true;
	}

	public function logout() {
		if (!User::isLoggedUser()) {
			return;
		} else {
			User::logout();
		}
    }
}
