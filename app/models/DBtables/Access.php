<?php

class Access {
    
    public function getAccess($uid) {
        $mysql = new MySQL();
        $uid = $mysql->validate($uid);
        
        $sql = 'SELECT
                    (CASE rola
                        WHEN 1 THEN "admin"
                        WHEN 2 THEN "zadavatel"
                        WHEN 3 THEN "uzivatel"
                        ELSE NULL
                    END) AS rola
                FROM pouzivatel
                WHERE id = "'. $uid .'"';
        return $mysql->get_one_assoc($sql)['rola'];
    }
    
    public function getAllAccess() {
//        TODO
    }
}
