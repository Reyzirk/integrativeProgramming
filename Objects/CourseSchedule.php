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
    
    public function getScheduleID() {
        return $this->scheduleID;
    }

    public function getCourse() {
        return $this->course;
    }

    public function getInstructor() {
        return $this->instructor;
    }

    public function getTimeStart() {
        return $this->timeStart;
    }

    public function getDuration() {
        return $this->duration;
    }

    public function getClassType() {
        return $this->classType;
    }

    public function setScheduleID($scheduleID): void {
        $this->scheduleID = $scheduleID;
    }

    public function setCourse($course): void {
        $this->course = $course;
    }

    public function setInstructor($instructor): void {
        $this->instructor = $instructor;
    }

    public function setTimeStart($timeStart): void {
        $this->timeStart = $timeStart;
    }

    public function setDuration($duration): void {
        $this->duration = $duration;
    }

    public function setClassType($classType): void {
        $this->classType = $classType;
    }



}
