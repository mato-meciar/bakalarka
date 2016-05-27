<?php

class Group {

	public static function getGroupList() {
        $mysql = new MySQL();
        
        $sql = "SELECT s.id, s.nazov, s.email, s.veduci_id, s.schopnosti, s.clenovia
                FROM skupina s";

        return $mysql->get_all($sql);
    }

	public static function getGroupListOrderById() {
		$mysql = new MySQL();

		$sql = "SELECT s.id, s.nazov, s.email, s.veduci_id, s.schopnosti, s.preferencie, s.clenovia
                FROM skupina s
                ORDER BY s.id";

		return $mysql->get_all($sql);
	}

	public static function getGroup($group_id) {
        $mysql = new MySQL();
        $groupID = $mysql->validate($group_id);
        
        $sql = "SELECT s.id, s.nazov, s.email, s.veduci_id, s.schopnosti, s.clenovia
                FROM skupina s
                WHERE s.id = '$groupID'";
        return $mysql->get_one($sql);
    }

	public static function existsGroupByLeader($leader_id) {
        $mysql = new MySQL();
        $leaderID = $mysql->validate($leader_id);

        $sql = "SELECT EXISTS (SELECT * FROM skupina WHERE veduci_id = '$leaderID') AS exist";
        return boolval($mysql->get_one_assoc($sql)['exist']);
    }

	public static function getGroupByLeader($leader_id) {
        $mysql = new MySQL();
        $leaderID = $mysql->validate($leader_id);

        $sql = "SELECT s.id, s.nazov, s.email, s.veduci_id, s.schopnosti, s.clenovia, s.preferencie
                FROM skupina s
                WHERE s.veduci_id = '$leaderID'";
        return $mysql->get_one($sql);
    }

	public static function addGroup($name, $email, $leader_id, $skills, $members) {
        $mysql = new MySQL();
        $name = $mysql->validate($name);
        $email = $mysql->validate($email);
        $leader_id = $mysql->validate($leader_id);
        $skills = $mysql->validate($skills);
        $members = $mysql->validate($members);
        
        $sql = "INSERT INTO skupina (nazov, email, veduci_id, schopnosti, clenovia, preferencie)
                VALUES('$name', '$email', '$leader_id', '$skills', '$members', '')";
        $result = $mysql->set($sql);
        return true;
    }

	public static function updateGroup($group_id, $name, $email, $skills, $members) {
        $mysql = new MySQL();
        $groupID = $mysql->validate($group_id);
        $name = $mysql->validate($name);
        $email = $mysql->validate($email);
        $skills = $mysql->validate($skills);
        $members = $mysql->validate($members);
        
        $sql = 'UPDATE skupina
                SET 
                    '.(($name != '') ? 'nazov = "'.$name.'",' : '').'
                    '.(($email != '') ? 'email = "'.$email.'",' : '').'
                    '.(($skills != '') ? 'schopnosti = "'.$skills.'",' : '').'
                    '.(($members != '') ? 'clenovia = "'.$members.'"' : '').'
                WHERE id = "'.$groupID.'"';
        return $mysql->set($sql);
    }

	public static function updatePreferences($preferences, $groupID) {
        $mysql = new MySQL();
        $preferences = $mysql->validate($preferences);
        
        $sql = 'UPDATE skupina
                SET 
                    preferencie = "'.$preferences.'"
                WHERE id = "'.$groupID.'"';
        return $mysql->set($sql);
    }
    
}
