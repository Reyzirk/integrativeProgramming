<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of InstructorDB
 *
 * @author Choo Meng
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Database/DBController.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Database/MySQLQueryBuilder.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Objects/Instructor.php';
class InstructorDB {
    private $instance;
    public function __construct(){
        $this->instance = DBController::getInstance();
    }
    public function list(){
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("instructor"), array("*"))
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->execute();
        $resultList = array();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return $resultList;
        }else{
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            foreach($results as $row){
                $result = new Instructor($row["InstructorID"],$row["InstructorName"],$row["EmployeeDate"],$row["Gender"],$row["BirthDate"],$row["Email"],$row["ContactNumber"],$row["ICNo"]);
                $resultList[] = $result;
            }
            return $resultList;
        }
        
    }
    public function validID($id): bool{
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("instructor"), array("*"))
                ->where("InstructorID", $id)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return false;
        }else{
            return true;
        }
    }
    
}
