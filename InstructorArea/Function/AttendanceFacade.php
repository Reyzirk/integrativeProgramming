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
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/ChildClassDB.php';
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/deletionLogDB.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/Attendance.php";

class AttendanceFacade {

    protected $attendanceDB;
    protected $childDB;
    protected $classDB;
    protected $childClassDB;
    protected $deletionLogDB;

    public function __construct() {
        $this->attendanceDB = new AttendanceDB();
        $this->childDB = new ChildDB();
        $this->classDB = new ClassDB();
        $this->childClassDB = new ChildClassDB();
        $this->deletionLogDB = new deletionLogDB();
    }

    public function getTotalAttendanceRecord() {
        return $this->attendanceDB
                        ->getRecordCount();
    }

    public function selectAllAttendanceRecord() {
        return $this->attendanceDB
                        ->selectAll();
    }

    public function getChildName($childID) {
        return
                        $this->childDB
                        ->getChildDetails($childID)
                ->childName;
    }

    public function getClassDetails($childID) {
        $classID = $this->childDB
                        ->getChildClass($childID)
                ->classID;
        return $this->classDB
                        ->details($classID);
    }

    public function getAttendanceRecords($childName) {
        return $this->attendanceDB->getAttendanceRecord($childName);
    }
    
    public function getAttendanceRecordDate($date){
        return $this->attendanceDB->getAttendanceRecordDate($date);
    }
    
    public function insertAttendance(Attendance $attendance){
        return $this->attendanceDB->insertAttendanceRecord($attendance);
    }

    public function checkForValidChildID($childID) {
        return $this->childDB->validChildID($childID);
    }

    public function checkIfAttendanceExists($childID, $attendanceDate) {
        return $this->attendanceDB->ifAttendanceExist($childID, $attendanceDate);
    }

    public function selectClasses($query) {
        return $this->classDB->select($query);
    }

    public function getClassCount() {
        return $this->classDB->getTotalRows();
    }
    
    public function getClassCountSearch($search){
        return $this->classDB->getCount($search);
    }
    
    public function checkForValidClassID($classID){
        return $this->classDB->validID($classID);
    }
    
    public function getChildIDFromClassID($query){
        return $this->childClassDB->select($query);
    }
    
    public function deleteAttendanceLog($attendanceID){
        date_default_timezone_set('Asia/Kuala_Lumpur');
        $deletedOn = date('l jS \of F Y h:i:s A');
        $results = $this->attendanceDB->getAttendanceRecordID($attendanceID);
        foreach ($results as $row){
            $attendance = new Attendance($row["ChildID"],$row["ChildTemperature"],$row["AttendingDate"]);
            
        }
        //print_r($attendance);
        if ($this->attendanceDB->deleteAttendanceRecord($attendanceID) == true){
            return $this->deletionLogDB->recordDeletionLog($attendance,$attendanceID,$deletedOn);
        }
        else{
            return false;
        }
        
    }
    
    public function getAttendanceRecordFromParentID($parentID){
        return $this->attendanceDB->getAttendanceRecordParentID($parentID);
    }

}
