<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Database/DBController.php';
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/MySQLQueryBuilder.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Objects/Classes.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Objects/Attendance.php';

class deletionLogDB{
    private $instance; 
    public function __construct(){
        $this->instance = DBController::getInstance();
    }
    
    function recordDeletionLog(Attendance $attendance, $attendanceID){
        $query="INSERT INTO deletionlog (ChildID, ChildTemperature, AttendingDate, AttendanceID) VALUES (?,?,?,?)";
        $stmt = $this->instance->con->prepare($query);
        $childID = $attendance->childID;
        $temperature = $attendance->childTemp;
        $attendingDate = $attendance->attending;
        $stmt->bindParam(1,$childID, PDO::PARAM_STR);
        $stmt->bindParam(2,$temperature, PDO::PARAM_STR);
        $stmt->bindParam(3,$attendingDate, PDO::PARAM_STR);
        $stmt->bindParam(4,$attendanceID, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        
         if ($totalrows==0){
            return false;
        }else{
            return true;
        }
    }
}
