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

    public function __construct() {
        $this->instance = DBController::getInstance();
    }

    public function getRecordCount() {
        $query = "SELECT * FROM attendance";
        $stmt = $this->instance->con->prepare($query);
        $stmt->execute();
        $totalrows = $stmt->rowCount();

        if ($totalrows == 0) {
            DBController::closeConnection();
            return 0;
        } else {
            DBController::closeConnection();
            return $totalrows;
        }
        
    }

    public function selectAll() {
        $query = "SELECT * FROM attendance";
        $stmt = $this->instance->con->prepare($query);
        $stmt->execute();
        $totalrows = $stmt->rowCount();

        if ($totalrows == 0) {
            DBController::closeConnection();
            return NULL;
        } else {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            DBController::closeConnection();
            return $result;
        }
    }

    public function getAttendanceRecordID($attendanceID) {
        $query = "SELECT * FROM  attendance WHERE AttendanceID = ?";
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $attendanceID, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();

        if ($totalrows == 0) {
            DBController::closeConnection();
            return NULL;
        } else {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            DBController::closeConnection();
            return $result;
        }
    }

    public function deleteAttendanceRecord($attendanceID) {
        $query = "DELETE FROM attendance WHERE AttendanceID = ?";
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $attendanceID, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();

        if ($totalrows == 0) {
            DBController::closeConnection();
            return false;
        } else {
            DBController::closeConnection();
            return true;
        }
    }

    public function insertAttendanceRecord(Attendance $attendance) {
        $query = "INSERT INTO attendance (ChildID, ChildTemperature, AttendingDate) VALUES (?,?,?)";
        $stmt = $this->instance->con->prepare($query);
        $childID = $attendance->childID;
        $temperature = $attendance->childTemp;
        $attendingDate = $attendance->attending;
        $stmt->bindParam(1, $childID, PDO::PARAM_STR);
        $stmt->bindParam(2, $temperature, PDO::PARAM_STR);
        $stmt->bindParam(3, $attendingDate, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows == 0) {
            DBController::closeConnection();
            return false;
        } else {
            DBController::closeConnection();
            return true;
        }
    }

    public function getAttendanceRecord($childName) {
        $query = "SELECT * "
                . "FROM attendance AS a "
                . "JOIN child AS c "
                . "ON a.ChildID = c.ChildID "
                . "WHERE c.ChildName LIKE :term ";
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindValue(':term', '%' . $childName . '%');
        $stmt->execute();
        $totalrows = $stmt->rowCount();

        if ($totalrows == 0) {
            DBController::closeConnection();
            return NULL;
        } else {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            DBController::closeConnection();
            return $result;
        }
    }

    public function getAttendanceRecordDate($date) {
        $query = "SELECT * FROM  attendance WHERE AttendingDate = ?";
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $date, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();

        if ($totalrows == 0) {
            DBController::closeConnection();
            return NULL;
        } else {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            DBController::closeConnection();
            return $result;
        }
    }

    public function getAttendanceRecordParentID($parentID) {
        $query = "SELECT * "
                . "FROM attendance "
                . "JOIN child "
                . "ON attendance.ChildID = child.ChildID " 
                . "JOIN parent "
                . "ON parent.ParentID = child.ParentID "
                . "WHERE parent.ParentID = ?";
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $parentID, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        
        if ($totalrows == 0) {
            DBController::closeConnection();
            return NULL;
        } else {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            DBController::closeConnection();
            return $result;
        }
    }

    public function ifAttendanceExist($childID, $attendanceDate) {
        $query = "SELECT * FROM attendance WHERE ChildID = ? AND AttendingDate = ?";
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $childID, PDO::PARAM_STR);
        $stmt->bindParam(2, $attendanceDate, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();

        if ($totalrows == 0) {
            DBController::closeConnection();
            return false;
        } else {
            DBController::closeConnection();
            return true;
        }
    }

}
