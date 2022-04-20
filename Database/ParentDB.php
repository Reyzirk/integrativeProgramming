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
    
    public function getParentDetails ($id){
        $query = "SELECT * FROM parent WHERE ParentID = ?";
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_STR);
         $stmt->execute();
        $totalrows = $stmt->rowCount();
        
        if ($totalrows == 0){
            return NULL;
        }
        else{
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            return $result;
        }
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
        $query = "INSERT INTO parent VALUES(?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->instance->con->prepare($query);

        $parentID = $parent->userID;
        $parentName = $parent->name;
        $parentGender = $parent->gender;
        $parentBirth = $parent->birthDate;
        $parentEmail = $parent->email;
        $parentPhoneNo = $parent->contactNumber;
        $parentIcNo = $parent->icNo;
        $parentType = $parent->parentType;
        $addressID = $parent->addressID;
        $password = $parent->password;

        $stmt->bindParam(1, $parentID, PDO::PARAM_STR);
        $stmt->bindParam(2, $parentName, PDO::PARAM_STR);
        $stmt->bindParam(3, $parentGender, PDO::PARAM_STR);
        $stmt->bindParam(4, $parentBirth, PDO::PARAM_STR);
        $stmt->bindParam(5, $parentEmail, PDO::PARAM_STR);
        $stmt->bindParam(6, $parentPhoneNo, PDO::PARAM_STR);
        $stmt->bindParam(7, $parentIcNo, PDO::PARAM_STR);
        $stmt->bindParam(8, $parentType, PDO::PARAM_STR);
        $stmt->bindParam(9, $addressID, PDO::PARAM_STR);
        $stmt->bindParam(10, $password, PDO::PARAM_STR);
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
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows == 0) {
            return false;
        } else {
            return true;
        }
    }
    
    public function updatePassword($parentID, $password) {
        $builder = new MySQLQueryBuilder();
        $query = "UPDATE `parent` SET `Password` = ? WHERE `ParentID` = ?";
        
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
    
    public function update($oldID, $updated) {
        $builder = new MySQLQueryBuilder();
        $query = $builder->update("parent", array("ParentName" => \CustomSQLEnum::BIND_QUESTIONMARK,
                    "ParentGender" => \CustomSQLEnum::BIND_QUESTIONMARK,
                    "ParentBirth" => \CustomSQLEnum::BIND_QUESTIONMARK,
                    "ParentEmail" => \CustomSQLEnum::BIND_QUESTIONMARK,
                    "ParentPhoneNo" => \CustomSQLEnum::BIND_QUESTIONMARK,
                    "ParentIcNo" => \CustomSQLEnum::BIND_QUESTIONMARK, 
                    "ParentType" => \CustomSQLEnum::BIND_QUESTIONMARK))
                ->where("ParentID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        
        $parentID = $oldID;
        $parentName = $updated->name;
        $parentGender = $updated->gender;
        $parentBirth = $updated->birthDate;
        $parentEmail = $updated->email;
        $parentPhoneNo = $updated->contactNumber;
        $parentIcNo = $updated->icNo;
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
    
    public function updateParentSide($oldID, $updated) {
        $builder = new MySQLQueryBuilder();
        $query = $builder->update("parent", array("ParentName" => \CustomSQLEnum::BIND_QUESTIONMARK,
                    "ParentGender" => \CustomSQLEnum::BIND_QUESTIONMARK,
                    "ParentBirth" => \CustomSQLEnum::BIND_QUESTIONMARK,
                    "ParentPhoneNo" => \CustomSQLEnum::BIND_QUESTIONMARK,
                    "ParentIcNo" => \CustomSQLEnum::BIND_QUESTIONMARK, 
                    "ParentType" => \CustomSQLEnum::BIND_QUESTIONMARK))
                ->where("ParentID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        
        $parentID = $oldID;
        $parentName = $updated->name;
        $parentGender = strtoupper(substr($updated->gender,0,1));
        $parentBirth = $updated->birthDate;
        $parentPhoneNo = $updated->contactNumber;
        $parentIcNo = $updated->icNo;
        $parentType = $updated->parentType;
        
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $parentName, PDO::PARAM_STR);
        $stmt->bindParam(2, $parentGender, PDO::PARAM_STR);
        $stmt->bindParam(3, $parentBirth, PDO::PARAM_STR);
        $stmt->bindParam(4, $parentPhoneNo, PDO::PARAM_STR);
        $stmt->bindParam(5, $parentIcNo, PDO::PARAM_STR);
        $stmt->bindParam(6, $parentType, PDO::PARAM_STR);
        $stmt->bindParam(7, $parentID, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows == 0) {
            return false;
        } else {
            return true;
        }
    }
    public function login($email){
        $query = "SELECT * FROM parent WHERE ParentEmail = ?";
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
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
    public function insertNewAccount($parent){
        $query = "INSERT INTO parent (parentID, parentName, ParentGender, ParentBirth,ParentEmail, ParentPhoneNo, ParentIcNo, ParentType, Password, AddressID) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->instance->con->prepare($query);
        $parents = $parent->userID;
        $parentName = $parent->name;
        $parentGender = strtoupper(substr($parent->gender,0,1));
        $parentBirth = $parent->birthDate;
        $parentEmail = $parent->email;
        $parentPhoneNo = $parent->contactNumber;
        $parentIcNo = $parent->icNo;
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
            return $totalrows;
        }
    }
    
    public function forgotPassword(){
        $query = "SELECT * FROM parent WHERE ParentEmail = ?, ParentName = ?";
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $parentEmail, PDO::PARAM_STR);
        $stmt->bindParam(2, $parentName, PDO::PARAM_STR);
        $stmt->execute();
        if($totalrows == 0){
            return false;
        }else{
            return $totalrows;
        }
    }
    
    public function resetPassword($email, $password){
        $builder = new MySQLQueryBuilder();
        $query = $builder->update("parent", array("Password" => \CustomSQLEnum::BIND_QUESTIONMARK))
                ->where("ParentEmail", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $password, PDO::PARAM_STR);
        $stmt->bindParam(2, $email, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows == 0) {
            return false;
        } else {
            return true;
        }
    }
    
    public function detailsWithEmail($email){
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("parent"), array("*"))
                ->where("ParentEmail", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
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
}

