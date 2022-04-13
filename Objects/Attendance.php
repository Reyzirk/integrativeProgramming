<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of Attendance
 *
 * @author Ng Kar Kai
 */
class Attendance {
    private  $childID, $childTemp, $attending;
    
    public function __construct($childID, $childTemp, $attending) {
        $this->childID = $childID;
        $this->childTemp = $childTemp;
        $this->attending = $attending;
    }
    
    public function __get($name) {
        if (property_exists($this, $name)){
            return $this->$name;
        }
        else{
            trigger_error("Non-existent property of $name",E_USER_ERROR);
        }
    }
    
    public function __set($name, $value){
        if (property_exists($name, $value)){
            $this->$name = $value;
        }
        else{
            trigger_error("Non-existent property of $name", E_USER_ERROR);
        }
    }
}
