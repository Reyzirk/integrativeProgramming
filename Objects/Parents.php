<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * Objects/Parent.php
 * 
 * @author Tang Khai Li
 */

class Parents{
    
    private $parentID, $parentName, $parentGender, $parentBirth, $parentEmail, $parentPhoneNo, $parentIcNo, $parentType, $addressID, $password;
    
    public function __construct($parentID, $parentName, $parentGender, $parentBirth, $parentEmail, $parentPhoneNo, $parentIcNo, $parentType, $addressID, $password) {
        $this->parentID = $parentID;
        $this->parentName = $parentName;
        $this->parentGender = $parentGender;
        $this->parentBirth = $parentBirth;
        $this->parentEmail = $parentEmail;
        $this->parentPhoneNo = $parentPhoneNo;
        $this->parentIcNo = $parentIcNo;
        $this->parentType = $parentType;
        $this->addressID = $addressID;
        $this->password = $password;
    }
    
    public function __get($name) {
        if (property_exists($this, $name)){
            return $this->$name;
        }else{
            trigger_error("Property $name doesn't exists", E_USER_ERROR);
        }
    }
    
    public function __set($name, $value) {
        if (property_exists($this, $name)){
            $this->$name = $value;
        }else{
            trigger_error("Property $name doesn't exists", E_USER_ERROR);
        }
    }
    
}

