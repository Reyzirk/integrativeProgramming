<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of ChildTemperature
 *
 * @author Ng Kar Kai
 */
class ChildTemperature {
    
    private $id, $code, $desc, $safetyLevel;
    
    public function __construct($id = "", $code = "", $desc = "", $safetyLevel = "") {
        $this->id = $id;
        $this->code = $code;
        $this->desc = $desc; 
        $this->safetyLevel = $safetyLevel;
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
    
    public function __toString() {
        return "Temperature Level: ".$this->id."</br>Code:".$this->code."</br>Description:".$this->desc."</br>Safety Level:".$this->safetyLevel;
    }
}
