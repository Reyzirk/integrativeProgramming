<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 *
 *@author Fong Shu Ling 
 *  
 */

class Address{
    
    private $addressID, $address, $city, $state, $postcode;
    
    public function __construct($addressID, $address, $city, $state, $postcode) {
        $this -> addressID = $addressID;
        $this -> address = $address;
        $this -> city = $city;
        $this -> state = $state;
        $this -> postcode = $postcode;
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
