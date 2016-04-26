<?php

class Project {
    
    public function getProjectList($uid = null) {
        $mysql = new MySQL();
        
        if ($uid != null) {
            $sql = "SELECT p.id, p.nazov, p.popis, p.vytvoril_id, p.skupina_id, p.oblast, p.platforma, p.technologie, p.schvaleny, p.dolezity, p.rok
                    FROM projekt p WHERE p.vytvoril_id = '$uid'";
        } else {
            $sql = "SELECT p.id, p.nazov, p.popis, p.vytvoril_id, p.skupina_id, p.oblast, p.platforma, p.technologie, p.schvaleny, p.dolezity, p.rok
                    FROM projekt p";
        }
        return $mysql->get_all($sql);
    }
    
    public function getApprovalProjectList() {
        $mysql = new MySQL();

        $sql = "SELECT p.id, p.nazov, p.popis, p.vytvoril_id, p.skupina_id, p.oblast, p.platforma, p.technologie, p.schvaleny, p.dolezity, p.rok
                FROM projekt p
                WHERE p.schvaleny = 0";
        return $mysql->get_all($sql);
    }
    
        public function getUnapprovedCount() {
        $mysql = new MySQL();

        $sql = "SELECT COUNT(*) neschvalenych
                FROM projekt p
                WHERE p.schvaleny = 0";
        return $mysql->get_one($sql);
    }
    
    public function getProject($project_id) {
        $mysql = new MySQL();
        $projectID = $mysql->validate($project_id);
        
        $sql = "SELECT p.id, p.nazov, p.popis, p.vytvoril_id, p.skupina_id, p.oblast, p.platforma, p.technologie, p.schvaleny, p.dolezity, p.rok
                FROM projekt p
                WHERE p.id = '$projectID'";
        return $mysql->get_one($sql);
    }
    
    public function getProjectStatus($project_id) {
        $mysql = new MySQL();
        $project_id = $mysql->validate($project_id);
        
        $sql = "SELECT id,
                (CASE schvaleny
                    WHEN '0' THEN 'Nie'
                    WHEN '1' THEN 'Ano'
                    ELSE 'N/A'
                END) status
                FROM projekt
                WHERE id = '$project_id'";
        return $mysql->get_all($sql);
    }
    
    public function addProject($name, $details, $creator_id, $domain, $platform, $technologies, $year) {
        $mysql = new MySQL();
        $name = $mysql->validate($name);
        $details = $mysql->validate($details);
        $creator_id = $mysql->validate($creator_id);
        $domain = $mysql->validate($domain);
        $platform = $mysql->validate($platform);
        $technologies = $mysql->validate($technologies);
        $year = $mysql->validate($year);
        
        $sql = "INSERT INTO projekt(nazov, popis, vytvoril_id, oblast, platforma, technologie, rok)
                VALUES('$name', '$details', '$creator_id', '$domain', '$platform', '$technologies', '$year')";
        if ($mysql->set($sql)) {
            $sql = 'SELECT LAST_INSERT_ID()';
            return $mysql->get_one($sql)[0];
        } else {
            return false;
        }
    }
    
    public function updateProject($project_id, $name, $details, $domain, $platform, $technologies) {
        $mysql = new MySQL();
        $projectID = $mysql->validate($project_id);
        $name = $mysql->validate($name);
        $details = $mysql->validate($details);
        $domain = $mysql->validate($domain);
        $platform = $mysql->validate($platform);
        $technologies = $mysql->validate($technologies);
        
        $sql = 'UPDATE projekt
                SET 
                    '.(($name != '') ? 'nazov = "'.$name.'",' : '').'
                    '.(($details != '') ? 'popis = "'.$details.'",' : '').'
                    '.(($domain != '') ? 'oblast = "'.$domain.'",' : '').'
                    '.(($platform != '') ? 'platforma = "'.$platform.'",' : '').'
                    '.(($technologies != '') ? 'technologie = "'.$technologies.'"' : '').'
                WHERE id = "'.$projectID.'"';
        return $mysql->set($sql);
    }
    
    public function approve($projectID) {
        $mysql = new MySQL();
        $projectID = $mysql->validate($projectID);
        
        $sql = 'UPDATE projekt
                SET 
                    schvaleny = 1
                WHERE id = "'.$projectID.'"';
        return $mysql->set($sql);
    }
    
}
