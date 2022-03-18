<?php
/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
/**
 * Description of StudClass
 *
 * @author Choo Meng
 */
class Classes {
    private $classID, $semester, $year, $formTeacher, $classStart, $classEnd;
    public function __construct($classID, $semester, $year, $formTeacher, $classStart = NULL, $classEnd = NULL) {
        $this->classID = $classID;
        $this->semester = $semester;
        $this->year = $year;
        $this->formTeacher = $formTeacher;
        $this->classStart = $classStart;
        $this->classEnd = $classEnd;
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
