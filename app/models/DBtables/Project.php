<?php

class Project {
    
    public function getProjectList() {
        $mysql = new MySQL();
        
        $sql = 'SELECT p.id, p.nazov, p.popis, p.vytvoril_id, p.skupina_id, p.klucove_slova, p.schvaleny, p.rok
                FROM projekt p';
        return $mysql->get_all($sql);
    }
    
    public function getProject($project_id) {
        $mysql = new MySQL();
        $project_id = $mysql->validate($project_id);
        
        $sql = 'SELECT p.id, p.nazov, p.popis, p.vytvoril_id, p.skupina_id, p.klucove_slova, p.schvaleny, p.rok
                FROM projekt p
                WHERE p.id = "' . $project_id . '"';
        return $mysql->get_one($sql);
    }
    
    public function getProjectStatus($project_id) {
        $mysql = new MySQL();
        $project_id = $mysql->validate($project_id);
        
        $sql = 'SELECT id,
                (CASE schvaleny
                    WHEN "0" THEN "Nie"
                    WHEN "1" THEN "Ano"
                    ELSE "N/A"
                END) status
                FROM projekt
                WHERE id = "' . $project_id .'"';
        return $mysql->get_all($sql);
    }
    
    public function addProject($name, $details, $creator_id, $key_words, $year) {
        $mysql = new MySQL();
        $name = $mysql->validate($name);
        $details = $mysql->validate($details);
        $creator_id = $mysql->validate($creator_id);
        $key_words = $mysql->validate($key_words);
        $year = $mysql->validate($year);
        
        $sql = 'INSERT INTO projekt(nazov, popis, vytvoril_id, skupina_id, klucove_slova, schvaleny, rok)
                VALUES("'.$name.'","'.$details.'","'.$creator_id.'","","'.$key_words.'","","'.$year.'")';
//        mozno problem s LAST_INSERT_ID !!!
        if ($mysql->set($sql)) {
            $sql = 'SELECT LAST_INSERT_ID()';
            return $mysql->get_one($sql)[0];
        } else {
            return false;
        }
    }
    
    public function updateProject($project_id, $name, $details, $key_words, $year) {
        $mysql = new MySQL();
        $project_id = $mysql->validate($project_id);
        $name = $mysql->validate($name);
        $details = $mysql->validate($details);
        $key_words = $mysql->validate($key_words);
        $year = $mysql->validate($year);
        
        $sql = 'UPDATE projekt
                SET 
                    '.(($name != '') ? 'nazov = "'.$name.'",' : '').'
                    '.(($details != '') ? 'popis = "'.$details.'",' : '').'
                    '.(($key_words != '') ? 'klucove_slova = "'.$key_words.'",' : '').'
                    '.(($year != '') ? 'rok = "'.$year.'",' : '').'
                WHERE id = "'.$project_id.'"';
        return $mysql->set($sql);
    }
    
}
