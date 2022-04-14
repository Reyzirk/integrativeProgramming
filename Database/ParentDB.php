<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * Database/ParentDB.php
 * 
 * @author Tang Khai Li
 */

require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Database/DBController.php';
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/MySQLQueryBuilder.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Objects/Parents.php';

class ParentDB{
    private $instance;

    public function __construct() {
        $this->instance = DBController::getInstance();
    }
    
    public function select($query){
        $stmt = $this->instance->con->prepare($query);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows == 0) {
            return NULL;
        } else{
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            return $result;
        }
    }
    
    public function insert($parent) {
        $builder = new MySQLQueryBuilder();
        $query = $builder->insert("parent")
                ->values(array(\CustomSQLEnum::BIND_QUESTIONMARK, \CustomSQLEnum::BIND_QUESTIONMARK, \CustomSQLEnum::BIND_QUESTIONMARK, \CustomSQLEnum::BIND_QUESTIONMARK, 
                    \CustomSQLEnum::BIND_QUESTIONMARK, \CustomSQLEnum::BIND_QUESTIONMARK, \CustomSQLEnum::BIND_QUESTIONMARK, \CustomSQLEnum::BIND_QUESTIONMARK))
                ->query();
        $stmt = $this->instance->con->prepare($query);

        $parentID = $parent->parentID;
        $parentName = $parent->parentName;
        $parentGender = $parent->parentGender;
        $parentBirth = $parent->parentBirth;
        $parentEmail = $parent->parentEmail;
        $parentPhoneNo = $parent->parentPhoneNo;
        $parentIcNo = $parent->parentIcNo;
        $parentType = $parent->parentType;

        $stmt->bindParam(1, $parentID, PDO::PARAM_STR);
        $stmt->bindParam(2, $parentName, PDO::PARAM_STR);
        $stmt->bindParam(3, $parentGender, PDO::PARAM_STR);
        $stmt->bindParam(4, $parentBirth, PDO::PARAM_STR);
        $stmt->bindParam(5, $parentEmail, PDO::PARAM_STR);
        $stmt->bindParam(6, $parentPhoneNo, PDO::PARAM_STR);
        $stmt->bindParam(7, $parentIcNo, PDO::PARAM_STR);
        $stmt->bindParam(8, $parentType, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows == 0) {
            return false;
        } else {
            return true;
        }
    }
    
    public function delete($id) {
        $builder = new MySQLQueryBuilder();
        $query = $builder->delete("parent")
                ->where("ParentID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows == 0) {
            return false;
        } else {
            return true;
        }
    }
    
    public function update($oldID, $updated) {
        $builder = new MySQLQueryBuilder();
        $query = $builder->update("parent", array("ParentName" => \CustomSQLEnum::BIND_QUESTIONMARK,
                    "ParentGender" => \CustomSQLEnum::BIND_QUESTIONMARK,
                    "ParentBirth" => \CustomSQLEnum::BIND_QUESTIONMARK,
                    "ParentEmail" => \CustomSQLEnum::BIND_QUESTIONMARK,
                    "ParentPhoneNo" => \CustomSQLEnum::BIND_QUESTIONMARK,
                    "ParentIcNo" => \CustomSQLEnum::BIND_QUESTIONMARK, 
                    "ParentType" => \CustomSQLEnum::BIND_QUESTIONMARK,))
                ->where("ParentID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        
        $parentID = $oldID;
        $parentName = $updated->parentName;
        $parentGender = $updated->parentGender;
        $parentBirth = $updated->parentBirth;
        $parentEmail = $updated->parentEmail;
        $parentPhoneNo = $updated->parentPhoneNo;
        $parentIcNo = $updated->parentIcNo;
        $parentType = $updated->parentType;
        
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $parentName, PDO::PARAM_STR);
        $stmt->bindParam(2, $parentGender, PDO::PARAM_STR);
        $stmt->bindParam(3, $parentBirth, PDO::PARAM_STR);
        $stmt->bindParam(4, $parentEmail, PDO::PARAM_STR);
        $stmt->bindParam(5, $parentPhoneNo, PDO::PARAM_STR);
        $stmt->bindParam(6, $parentIcNo, PDO::PARAM_STR);
        $stmt->bindParam(7, $parentType, PDO::PARAM_STR);
        $stmt->bindParam(8, $oldID, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows == 0) {
            return false;
        } else {
            return true;
        }
    }
    
    public function details($id) {
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("parent"), array("*"))
                ->where("ParentID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows == 0) {
            return NULL;
        } else {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            $row = $results[0];
            $result = new Announcement($row["ParentID"], $row["ParentName"], $row["ParentGender"], $row["ParentBirth"],
                    $row["ParentEmail"], $row["ParentPhoneNo"], $row["ParentIcNo"], $row["ParentType"]);
            $resultList = $result;
            return $resultList;
        }
    }
    
    
}

