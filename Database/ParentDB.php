<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * Database/ParentDB.php
 * 
 * @author Tang Khai Li, Fong Shu Ling
 */

require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Database/DBController.php';
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/MySQLQueryBuilder.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Objects/Parents.php';

class ParentDB{
    private $instance;

    public function __construct() {
        $this->instance = DBController::getInstance();
    }
    
    public function details($id){
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("parent"), array("*"))
                ->where("ParentID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return NULL;
        }else{
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            $row = $results[0];
            $result = new Parents($row["ParentID"],$row["ParentName"],$row["ParentGender"],$row["ParentBirth"],$row["ParentEmail"],$row["ParentPhoneNo"],$row["ParentIcNo"],$row["ParentType"],$row["AddressID"],$row["Password"]);
            $resultList = $result;
            return $resultList;
        }
    }
    
    public function updatePassword($parentID, $password) {
        $builder = new MySQLQueryBuilder();
        $query = $builder->update("parent", array("Password" => \CustomSQLEnum::BIND_QUESTIONMARK))
                ->where("ParentID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $password, PDO::PARAM_STR);
        $stmt->bindParam(2, $parentID, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows == 0) {
            return false;
        } else {
            return true;
        }
    }
    
    public function login($email, $password){
        $query = "SELECT * FROM parent WHERE ParentEmail = ? AND Password=?";
        $stmt = $this->instance->con->prepare($query);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if($totalrows == 0){
            return false;
        }else{
            return true;
        }
                
    }
    
    public function insertNewAccount($parent){
        $query = "INSERT INTO parent (parentID, parentName, ParentGender, ParentBirth,ParentEmail, ParentPhoneNo, ParentIcNo, ParentType, Password, AddressID) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->instance->con->prepare($query);
        $parents = $parent->parentID;
        $parentName = $parent->parentName;
        $parentGender = substr($parent->parentGender,0,1);
        $parentBirth = $parent->parentBirth;
        $parentEmail = $parent->parentEmail;
        $parentPhoneNo = $parent->parentPhoneNo;
        $parentIcNo = $parent->parentIcNo;
        $parentType = $parent->parentType;
        $password = $parent->password;
        $addressid = $parent->addressID;
        $stmt->bindParam(1, $parents, PDO::PARAM_STR);
        $stmt->bindParam(2, $parentName, PDO::PARAM_STR);
        $stmt->bindParam(3, $parentGender, PDO::PARAM_STR);
        $stmt->bindParam(4, $parentBirth, PDO::PARAM_STR);
        $stmt->bindParam(5, $parentEmail, PDO::PARAM_STR);
        $stmt->bindParam(6, $parentPhoneNo, PDO::PARAM_STR);
        $stmt->bindParam(7, $parentIcNo, PDO::PARAM_STR);
        $stmt->bindParam(8, $parentType, PDO::PARAM_STR);
        $stmt->bindParam(9, $password, PDO::PARAM_STR);
        $stmt->bindParam(10, $addressid, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows == 0 ){
            return 0;
        }
        else{
            return $totalrows;
        }
    }
    
    public function checkEmail($email){
        $query = "SELECT ParentEmail FROM parent WHERE ParentEmail = ?";
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $parentEmail, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if($totalrows == 0){
            return false;
        }else{
            return true;
        }
    }
        
}


