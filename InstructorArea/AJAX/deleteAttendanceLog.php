<?php
//Author: Ng Kar Kai
/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */ 
// Author: Ng Kar Kai
require_once "AJAXErrorHandler.php";
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__)))."\InstructorArea\Function\AttendanceFacade.php";

if (empty($_POST["attendanceID"])){
    echo "Fail";
}
else{
    $attendanceID = $_POST["attendanceID"];
    $facade = new AttendanceFacade();
    try{
        if ($facade->deleteAttendanceLog($attendanceID) == true){
            echo "success";
        }
        else{
            echo "The attendance ID is invalid.";
        }
    } catch (PDOException $ex) {
        if ($generalSection["maintenance"]==true){
            echo $ex->getMessage();
        }else{
            callPDOExceptionLog($ex);
        }
    }
}

function antiExploit($str) {
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}

