<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of attendanceFacade
 *
 * @author Ng Kar Kai
 */
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/AttendanceDB.php';
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/ChildDB.php';
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/ClassDB.php';

class AttendanceFacade {
    
    protected $attendanceDB;
    protected $childDB;
    protected $classDB;
    
    public function __construct() {
        $this->attendanceDB = new AttendanceDB();
        $this->childDB = new ChildDB();
        $this->classDB = new ClassDB();
    }
    
    public function getTotalAttendanceRecord(){
        return $this->attendanceDB
                ->getRecordCount();
    }
    public function selectAllAttendanceRecord(){
        return $this->attendanceDB
                ->selectAll();
    }
    
    public function getChildName($childID){
        return 
        $this->childDB
                ->getChildDetails($childID)
                ->childName;
    }
    
    public function getClassDetails($childID){
         $classID = 
                 $this->childDB
                ->getChildClass($childID)
                ->classID;
         return $this->classDB
                 ->details($classID);
    }
}
