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
    
    private $scheduleID,$courseCode, $classID, $instructor, $timeStart, $duration, $classType, $day;
   
    public function __construct($scheduleID,$courseCode, $classID, $instructor, $timeStart, $duration, $classType, $day) {
        $this->scheduleID = $scheduleID;
        $this->courseCode = $courseCode;
        $this->classID = $classID;
        $this->instructor = $instructor;
        $this->timeStart = $timeStart;
        $this->duration = $duration;
        $this->classType = $classType;
        $this->day = $day;
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
