<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of Timetable
 *
 * @author Choo Meng
 */
class Timetable {
    private $timetableID, $class, $classSchedule;
    
    public function __construct($timetableID, $class, $classSchedule) {
        $this->timetableID = $timetableID;
        $this->class = $class;
        $this->classSchedule = $classSchedule;
    }

    public function getTimetableID() {
        return $this->timetableID;
    }

    public function getClass() {
        return $this->class;
    }

    public function getClassSchedule() {
        return $this->classSchedule;
    }

    public function setTimetableID($timetableID): void {
        $this->timetableID = $timetableID;
    }

    public function setClass($class): void {
        $this->class = $class;
    }

    public function setClassSchedule($classSchedule): void {
        $this->classSchedule = $classSchedule;
    }

}
