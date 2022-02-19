<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of Examination
 *
 * @author Choo Meng
 */
class Examination {
    private $examinationID, $course, $examiner, $examStartTime, $examDuration;
    
    public function __construct($examinationID, $course, $examiner, $examStartTime, $examDuration) {
        $this->examinationID = $examinationID;
        $this->course = $course;
        $this->examiner = $examiner;
        $this->examStartTime = $examStartTime;
        $this->examDuration = $examDuration;
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
