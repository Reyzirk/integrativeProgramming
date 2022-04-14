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
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/User.php";

class Parents extends User{
    
    private $parentType, $addressID;
    
    public function __construct($parentID, $parentName, $parentGender, $parentBirth, $parentEmail, $parentPhoneNo, $parentIcNo, $parentType, $addressID, $password) {
        parent::__construct($parentID, $parentName, $parentGender, $parentBirth, $parentEmail, $parentPhoneNo, $parentIcNo, $password);
        $this->parentType = $parentType;
        $this->addressID = $addressID;
    }
    
    public function __get($name) {
        if (property_exists($this, $name)){
            
            return $this->$name;
        }else{
            
            return parent::__get($name);
        }
    }
    
    public function __set($name, $value) {
        if (property_exists($this, $name)){
            $this->$name = $value;
        }else{
            parent::__set($name, $value);
        }
    }
    
}