<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of ChildDB
 *
 * @author Ng Kar Kai
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Database/DBController.php';
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/MySQLQueryBuilder.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Objects/Child.php';
class ChildDB {
    private $instance;
    public function __construct(){
        $this->instance = DBController::getInstance();
    }
    
    public function getChildDetails($childID){
        $query = "SELECT * FROM Child WHERE ChildID = ?";
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $childID, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        
        if ($totalrows == 0 ){
            return NULL;
        }
        else{
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            $row = $results[0];
            $record = new Child($row["ChildID"], $row["ChildName"], $row["BirthDate"], $row["ChildICNo"], $row["Status"]);
            return $record;
        }
    }
}
