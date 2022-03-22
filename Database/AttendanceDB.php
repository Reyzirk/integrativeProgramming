<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of AttendanceDB
 *
 * @author Ng Kar Kai
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Database/DBController.php';
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/MySQLQueryBuilder.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Objects/Classes.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Objects/Attendance.php';
class AttendanceDB {
    private $instance; 
    public function __construct(){
        $this->instance = DBController::getInstance();
    }
    
    public function getRecordCount(){
        $query = "SELECT * FROM attendance";
        $stmt = $this->instance->con->prepare($query);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        
        if ($totalrows == 0 ){
            return 0;
        }
        else{
            return $totalrows;
        }
    }
    
    public function selectAll(){
        $query = "SELECT * FROM attendance";
        $stmt = $this->instance->con->prepare($query);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        
        if ($totalrows == 0 ){
            return NULL;
        }
        else{
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            return $result;
        }
    }
    
    public function getAttendanceRecord($childName){
        $query = "SELECT * "
                . "FROM attendance AS a "
                . "JOIN child AS c "
                . "ON a.ChildID = c.ChildID "
                . "WHERE c.ChildName LIKE :term ";
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindValue(':term','%'.$childName.'%');
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        
        if ($totalrows == 0){
            return NULL;
        }
        else{
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            return $result;
        }

    }
    
    public function ifAttendanceExist($childID, $attendanceDate){
        $query = "SELECT * FROM attendance WHERE ChildID = ? AND AttendingDate = ?";
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $childID, PDO::PARAM_STR);
        $stmt->bindParam(2, $attendanceDate, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        
        if ($totalrows==0){
            return false;
        }
        else{
            return true;
        }
    }
}
