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
 * @author clhsk
 */
class Attendance {
    private $attendanceID, $childID, $childTemp, $masked, $attending;
    
    public function __construct() {
        $this->attendanceID;
        $this->childID;
        $this->childTemp;
        $this->masked;
        $this->attending;
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
