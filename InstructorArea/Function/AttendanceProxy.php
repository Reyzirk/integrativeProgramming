<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of AttendanceProxy
 *
 * @author Ng Kar Kai
 */
require_once 'AttendanceFacade.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/Attendance.php";
interface AttendanceInterface {
    public function registerAttendance(Attendance $attendance):void;
}

class AttendanceLogger implements AttendanceInterface{
    public function registerAttendance(Attendance $attendance): void {
        $facade = new AttendanceFacade();
        $success = $facade->insertAttendance($attendance);
        
        if ($success == true){
            $_SESSION["attendanceSuccess"] = "<b>Attendance updated</b>";
            redirectsBack();
        }
        else{
            $_SESSION["attendanceFailed"] = "<b>Attendance Failed</b>";
            redirectsBack();
        }
    }
}

class AttendanceProxy implements AttendanceInterface{
    private $attendanceLogger;
    
    public function __construct(AttendanceLogger $attendanceLogger) {
        $this->attendanceLogger = $attendanceLogger;
    }
    public function registerAttendance(Attendance $attendance):void{
        if ($this->checkExistingAttendance($attendance) == false){
            $this->attendanceLogger->registerAttendance($attendance);
        }
    }
    
    public function checkExistingAttendance(Attendance $attendance){
        $facade = new AttendanceFacade();
        $childID = $attendance->childID;
        $attendanceDate = $attendance->attending;
        $exist = $facade->checkIfAttendanceExists($childID, $attendanceDate);
        
        if ($exist == true){
            return true;
        }
        else{
            return false;
        }
        
    }
}


function redirectsBack() {
    $classID = $_SESSION["classID"];
    unset($_SESSION["classID"]);
    header("location:insertChildAttendance.php?classID=$classID");
    die();
}
