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
class StudClass {
    private $classID, $studentList = array(), $semester, $year, $formTeacher;
    public function __construct($classID, $studentList, $semester, $year, $formTeacher) {
        $this->classID = $classID;
        $this->studentList = $studentList;
        $this->semester = $semester;
        $this->year = $year;
        $this->formTeacher = $formTeacher;
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
