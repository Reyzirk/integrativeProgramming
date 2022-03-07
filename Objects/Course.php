<?php
/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
/**
 * Description of Course
 *
 * @author Choo Meng
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/CourseMaterial.php";
class Course {
    private $courseCode, $courseName, $courseDesc,$courseMaterials = array();
    function __construct($courseCode, $courseName, $courseDesc, $courseMaterials){
        $this->courseCode = $courseCode;
        $this->courseName = $courseName;
        $this->courseDesc = $courseDesc;
        
        $this->courseMaterials = (array)$courseMaterials;
        
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
