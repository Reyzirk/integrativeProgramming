<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of ExaminationMark
 *
 * @author Choo Meng
 */
class ExamResult {
    private $examinationID, $childID, $mark;
    
    public function __construct($examinationID, $childID, $mark) {
        $this->examinationID = $examinationID;
        $this->childID = $childID;
        $this->mark = $mark;
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
