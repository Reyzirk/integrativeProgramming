<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
//Author: Ng Kar Kai
require_once ( str_replace("AJAX", "", dirname(__DIR__))) . '/Function/AttendanceFacade.php';
require_once ( str_replace("AJAX", "", dirname(__DIR__))) . '/Function/AttendanceProxy.php';
$facade = new AttendanceFacade();
$submitButton = false;
if (!isset($_GET['childID'])) { // if child ID is empty
    redirectsToPreviousPage();
} else {
    $childID = antiExploit($_GET['childID']);

    if ($facade->checkForValidChildID($childID) == true) {
        $childName = $facade->getChildName($childID);
        $childClass = $facade->getClassDetails($childID);
        $todayDate = date("Y-m-d");
        if ($facade->checkIfAttendanceExists($childID, $todayDate) == true) { // If Attendance does exist
            $_SESSION["attendanceExistError"] = "<b>Attendance record for $childName exists for today.</b>";
            redirectsToPreviousPage();
        }
    } else {
        redirectsToPreviousPage();
    }
}

if (isset($_POST["submitAttendance"])){
    $submitButton = true;
    
}

function proxyClient(AttendanceInterface $attendanceInterface){
    $attendanceInterface->registerAttendance();
}

function antiExploit($str) {
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}

function redirectsToPreviousPage() {
    header("location:javascript://history.go(-1)");
    die();
}
?>

