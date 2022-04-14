<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * Database/AddressDB.php
 * 
 * @author Fong Shu Ling
 */

require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Database/DBController.php';
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/MySQLQueryBuilder.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Objects/Address.php';

class AddressDB{
    private $instance;

    public function __construct() {
        $this->instance = DBController::getInstance();
    }
    
    public function getAllRecords(){
        $query = "SELECT * FORM address";
        $stmt = $this->instance->con->prepare($query);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        
        if ($totalrows == 0 ){
            return 0;
        }
        else{
            return $totalrows;
        }
    }
    
    public function insertNewAddress($address){
        $query = "INSERT INTO address (addressID, address, city, state, postcode) VALUES (?,?,?,?,?)";
        $stmt = $this->instance->con->prepare($query);
        $addressID = $address->addressID;
        $addresses = $address->address;
        $city = $address->city;
        $state = $address->state;
        $postcode = $address->postcode;
        $stmt->bindParam(1, $addressID, PDO::PARAM_STR);
        $stmt->bindParam(2, $addresses, PDO::PARAM_STR);
        $stmt->bindParam(3, $city, PDO::PARAM_STR);
        $stmt->bindParam(4, $state, PDO::PARAM_STR);
        $stmt->bindParam(5, $postcode, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows == 0 ){
            return 0;
        }
        else{
            return $totalrows;
        }
    }
    
    public function details($address){
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("address"), array("*"))
                ->where("AddressID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $address, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return NULL;
        }else{
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            $row = $results[0];
            $result = new Address($row["AddressID"],$row["Address"],$row["City"],$row["State"],$row["PostCode"]);
            $resultList = $result;
            return $resultList;
        }
    }
    
}