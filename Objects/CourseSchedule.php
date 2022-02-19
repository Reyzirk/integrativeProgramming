<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of CourseSchedule
 *
 * @author Choo Meng
 */
class CourseSchedule {
    
    private $scheduleID, $course, $instructor, $timeStart, $duration, $classType;
    
    public function __construct($scheduleID, $course, $instructor, $timeStart, $duration, $classType) {
        $this->scheduleID = $scheduleID;
        $this->course = $course;
        $this->instructor = $instructor;
        $this->timeStart = $timeStart;
        $this->duration = $duration;
        $this->classType = $classType;
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
