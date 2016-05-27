<?php

class Project {

	public static function getProjectList($uid = null) {
        $mysql = new MySQL();
        
        if ($uid != null) {
            $sql = "SELECT p.id, p.nazov, p.popis, p.vytvoril_id, p.skupina_id, p.oblast, p.platforma, p.technologie, p.schvaleny, p.dolezity, p.rok
                    FROM projekt p WHERE p.vytvoril_id = '$uid' ORDER BY p.id";
        } else {
            $sql = "SELECT p.id, p.nazov, p.popis, p.vytvoril_id, p.skupina_id, p.oblast, p.platforma, p.technologie, p.schvaleny, p.dolezity, p.rok
                    FROM projekt p ORDER BY p.id";
        }
        return $mysql->get_all($sql);
    }

	public static function getProjectListOrderById() {
		$mysql = new MySQL();
		$sql = "SELECT p.id, p.nazov, p.popis, p.vytvoril_id, p.skupina_id, p.oblast, p.platforma, p.technologie, p.schvaleny, p.dolezity, p.rok
                    FROM projekt p
                    WHERE (p.schvaleny = 1)
                    ORDER BY p.id";
		return $mysql->get_all($sql);
	}

	public static function getUnapprovedProjectList() {
        $mysql = new MySQL();

        $sql = "SELECT p.id, p.nazov, p.popis, p.vytvoril_id, p.skupina_id, p.oblast, p.platforma, p.technologie, p.schvaleny, p.dolezity, p.rok
                FROM projekt p
                WHERE p.schvaleny = 0 ORDER BY p.id";
        return $mysql->get_all($sql);
    }

	public static function getApprovedProjectList() {
        $mysql = new MySQL();

        $sql = "SELECT p.id, p.nazov, p.popis, p.vytvoril_id, p.skupina_id, p.oblast, p.platforma, p.technologie, p.schvaleny, p.dolezity, p.rok
                FROM projekt p
                WHERE p.schvaleny = 1 ORDER BY p.id";
        return $mysql->get_all($sql);
    }

	public static function getAssignedProjectList() {
		$mysql = new MySQL();

		$sql = "SELECT p.id, p.nazov, p.kontaktny_email, p.popis, p.vytvoril_id, p.skupina_id, p.oblast, p.platforma, p.technologie, p.schvaleny, p.dolezity, p.rok
                FROM projekt p
                WHERE p.skupina_id != -1 ORDER BY p.skupina_id";
		return $mysql->get_all($sql);
	}

	public static function getAssignedProjectListIds() {
		$mysql = new MySQL();

		$sql = "SELECT p.id, p.skupina_id
                FROM projekt p
                WHERE p.skupina_id != -1 ORDER BY p.skupina_id";
		$assignment = array();
		foreach ($mysql->get_all($sql) as $row) {
			$assignment[$row['id']] = $row['skupina_id'];
		}
		return $assignment;
	}

	public static function getUnapprovedCount() {
        $mysql = new MySQL();

        $sql = "SELECT COUNT(*) neschvalenych
                FROM projekt p
                WHERE p.schvaleny = 0";
        return $mysql->get_one($sql)['neschvalenych'];
    }

	public static function getProject($project_id) {
        $mysql = new MySQL();
        $projectID = $mysql->validate($project_id);

		$sql = "SELECT p.id, p.nazov, p.kontaktny_email, p.popis, p.vytvoril_id, p.skupina_id, p.oblast, p.platforma, p.technologie, p.schvaleny, p.dolezity, p.rok
                FROM projekt p
                WHERE p.id = '$projectID'";

		return $mysql->get_one($sql);
    }

	public static function getProjectIdByGroupId($group_id) {
		$mysql = new MySQL();
		$groupId = $mysql->validate($group_id);

		$sql = "SELECT p.id
                FROM projekt p
                WHERE p.skupina_id = '$groupId'";
		$result = $mysql->get_one($sql);
		return $result['id'];
	}

	public static function getProjectStatus($project_id) {
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
        $result =  $mysql->get_one($sql);
        if ($result != null && $result['status'] == "Ano") {
            return true;
        } else if ($result['status'] == "Nie") {
            return false;
        }
    }

	public static function assignProject($project_id, $group_id) {
		$mysql = new MySQL();
		$project_id = $mysql->validate($project_id);
		$group_id = $mysql->validate($group_id);

		$sql = 'UPDATE projekt
                SET 
                    skupina_id = ' . $group_id . '
                WHERE id = ' . $project_id;
		return $mysql->set($sql);
	}

	public static function resetAssignments() {
		$mysql = new MySQL();

		$sql = 'UPDATE projekt
                SET 
                    skupina_id = -1
                WHERE 1';
		$mysql->set($sql);
		$sql = 'UPDATE nastavenia
                SET 
                    boli_pridelene = 0
                WHERE 1';
		$mysql->set($sql);
	}

	public static function addProject($name, $email, $details, $creator_id, $domain, $platform, $technologies, $year) {
        $mysql = new MySQL();
        $name = $mysql->validate($name);
		$email = $mysql->validate($email);
        $details = $mysql->validate($details);
        $creator_id = $mysql->validate($creator_id);
        $domain = $mysql->validate($domain);
        $platform = $mysql->validate($platform);
        $technologies = $mysql->validate($technologies);
        $year = $mysql->validate($year);

		$sql = "INSERT INTO projekt(nazov, kontaktny_email, popis, vytvoril_id, oblast, platforma, technologie, rok)
                VALUES('$name', '$email', '$details', '$creator_id', '$domain', '$platform', '$technologies', '$year')";
        if ($mysql->set($sql)) {
            $sql = 'SELECT LAST_INSERT_ID()';
            return $mysql->get_one($sql)[0];
        } else {
            return false;
        }
    }

	public static function updateProject($project_id, $name, $email, $details, $domain, $platform, $technologies, $important) {
        $mysql = new MySQL();
		$projectId = $mysql->validate($project_id);
        $name = $mysql->validate($name);
		$email = $mysql->validate($email);
        $details = $mysql->validate($details);
        $domain = $mysql->validate($domain);
        $platform = $mysql->validate($platform);
        $technologies = $mysql->validate($technologies);
		$important = $mysql->validate($important);
		if ($important == "ano") {
			$important = 1;
		} else {
			$important = 0;
		}
        $sql = 'UPDATE projekt
                SET 
                    '.(($name != '') ? 'nazov = "'.$name.'",' : '').'
                    ' . (($email != '') ? 'kontaktny_email = "' . $email . '",' : '') . '
                    '.(($details != '') ? 'popis = "'.$details.'",' : '').'
                    '.(($domain != '') ? 'oblast = "'.$domain.'",' : '').'
                    '.(($platform != '') ? 'platforma = "'.$platform.'",' : '').'
                    ' . (($technologies != '') ? 'technologie = "' . $technologies . '",' : '') . '
                    dolezity = ' . $important . '
                WHERE id = "' . $projectId . '"';
        return $mysql->set($sql);
    }

	public static function approve($project_id) {
        $mysql = new MySQL();
		$project_id = $mysql->validate($project_id);
        
        $sql = 'UPDATE projekt
                SET 
                    schvaleny = 1
                WHERE id = "' . $project_id . '"';
        return $mysql->set($sql);
    }

	public static function delete($project_id) {
		$mysql = new MySQL();
		$project_id = $mysql->validate($project_id);

		$sql = 'DELETE FROM projekt
                WHERE id = "' . $project_id . '"';
		return $mysql->set($sql);
	}
    
}
