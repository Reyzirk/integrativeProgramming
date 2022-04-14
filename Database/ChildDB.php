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
 * @author Choo Meng
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Database/DBController.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Database/MySQLQueryBuilder.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Objects/Child.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Objects/ChildClass.php';
class ChildDB {
    private $instance;
    public function __construct(){
        $this->instance = DBController::getInstance();
    }
    public function validID($id): bool{
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("child"), array("*"))
                ->where("ChildID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return false;
        }else{
            return true;
        }
    }
    
    public function insertChildRecords($child):bool{
        $query = "INSERT INTO child VALUES (?,?,?,?,?,?)";
        $stmt = $this->instance->con->prepare($query);
        
        $childID = $child->childID; 
        $parentID = $child->parentID;
        $name = $child->childName;
        $birthdate = $child -> birthDate;
        $ic = $child->childICNo;
        $status = $child->status;
        
        $stmt->bindParam(1, $childID, PDO::PARAM_STR);
        $stmt->bindParam(2, $parentID, PDO::PARAM_STR);
        $stmt->bindParam(3, $name, PDO::PARAM_STR);
        $stmt->bindParam(4, $birthdate, PDO::PARAM_STR);
        $stmt->bindParam(5, $ic, PDO::PARAM_STR);
        $stmt->bindParam(6, $status, PDO::PARAM_STR);
        
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        
        if ($totalrows == 0){
            return false;
        }
        else{
            return true;
        }
    }
    
    public function validParent($id,$parentID): bool{
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("child"), array("*"))
                ->where("ChildID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->where("ParentID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_STR);
        $stmt->bindParam(2, $parentID, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return false;
        }else{
            return true;
        }
    }
    
    
    public function getChildDetails($childID){
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("child"), array("*"))
                ->where("ChildID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
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
            $record = new Child($row["ChildID"], $row["ParentID"], $row["ChildName"], $row["BirthDate"], $row["ChildICNo"], $row["Status"]);
            return $record;
        }
    }
    
    public function getChildList($parentID){
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("child"), array("*"))
                ->where("ParentID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $parentID, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        
        if ($totalrows == 0 ){
            return NULL;
        }
        else{
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            return $result;
        }
    }
    

    public function getChildClass($childID){
        $query = "SELECT * FROM childclass WHERE ChildID = ?";
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $childID, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        
        if ($totalrows == 0){
            return NULL;
        }
        else
        {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            $row = $results[0];
            $record = new ChildClass($row["ChildID"], $row["ClassID"], $row["Priority"]);
            return $record;
        }
    }
    
    public function validChildID($childID){
        $query = "SELECT * FROM child WHERE ChildID = ?";
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $childID, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        
        if ($totalrows==0){
            return false;
        }
        else{
            return true;
        }
    }
    
}
