<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of Grade
 *
 * @author Choo Meng
 */
class Grade {
    private $gradeID, $grade, $minMark, $maxMark;
    
    public function __construct($gradeID, $grade, $minMark, $maxMark) {
        $this->gradeID = $gradeID;
        $this->grade = $grade;
        $this->minMark = $minMark;
        $this->maxMark = $maxMark;
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
