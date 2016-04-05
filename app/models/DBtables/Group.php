<?php

class Group {
    
    public function getgroupList() {
        $mysql = new MySQL();
        
        $sql = "SELECT s.id, s.nazov, s.email, s.veduci_id, s.schopnosti, s.clenovia
                FROM skupina s";

        return $mysql->get_all($sql);
    }
    
    public function getGroup($group_id) {
        $mysql = new MySQL();
        $groupID = $mysql->validate($group_id);
        
        $sql = "SELECT s.id, s.nazov, s.email, s.veduci_id, s.schopnosti, s.clenovia
                FROM skupina s
                WHERE s.id = '$groupID'";
        return $mysql->get_one($sql);
    }
    
    public function existsGroupByLeader($leader_id) {
        $mysql = new MySQL();
        $leaderID = $mysql->validate($leader_id);

        $sql = "SELECT EXISTS (SELECT * FROM skupina WHERE veduci_id = '$leaderID') AS exist";
        return boolval($mysql->get_one_assoc($sql)['exist']);
    }
    
    public function getGroupByLeader($leader_id) {
        $mysql = new MySQL();
        $leaderID = $mysql->validate($leader_id);

        $sql = "SELECT s.id, s.nazov, s.email, s.veduci_id, s.schopnosti, s.clenovia
                FROM skupina s
                WHERE s.veduci_id = '$leaderID'";
        return $mysql->get_one($sql);
    }
    
    public function addGroup($name, $email, $leader_id, $skills, $members) {
        $mysql = new MySQL();
        $name = $mysql->validate($name);
        $email = $mysql->validate($email);
        $leader_id = $mysql->validate($leader_id);
        $skills = $mysql->validate($skills);
        $members = $mysql->validate($members);
        
        $sql = "INSERT INTO skupina(nazov, email, veduci_id, schopnosti, clenovia)
                VALUES('$name', '$email', '$leader_id', '$skills', '$members')";
        var_dump($sql);
//        mozno problem s LAST_INSERT_ID !!!
        if ($mysql->set($sql)) {
            $sql = 'SELECT LAST_INSERT_ID()';
            return $mysql->get_one($sql)[0];
        } else {
            return false;
        }
    }
    
    public function updategroup($group_id, $name, $email, $skills, $members) {
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
        var_dump($sql);
        return $mysql->set($sql);
    }
    
}