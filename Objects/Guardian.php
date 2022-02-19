<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of Guardian
 *
 * @author Choo Meng
 */
class Guardian extends User{
    private $address, $totalChild, $emergencyContactNumber, $child;
    
    public function __construct($userID, $name, $gender, $birthDate, $email, $contactNumber, $icNo, 
            $address, $totalChild, $emergencyContactNumber, $child, $password=null, $passwordSalt=null) {
        parent::__construct($userID, $name, $gender, $birthDate, $email, $contactNumber, $icNo, $password, $passwordSalt);
        $this->address = $address;
        $this->totalChild = $totalChild;
        $this->emergencyContactNumber = $emergencyContactNumber;
        $this->child = $child;
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
            parent::__set($name,$value);
        }
    }
}
