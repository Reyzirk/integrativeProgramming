<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
//Authoer: Ng Kar Kai
require_once ( str_replace("AJAX", "", dirname(__DIR__))) . '/Function/AttendanceFacade.php';
$facade = new AttendanceFacade();
$submitBtn = false;
if (!isset($_GET['classID'])){ // If Class ID is empty
    $_SESSION["attendanceExistError"] = "<b>Empty Class ID attempted.</b>";
    redirectsToPreviousPage();
}
else{
    $classID = antiExploit($_GET['classID']);
    if($facade->checkForValidClassID($classID) == true){
        $todayDate = date("Y-m-d");
        $_SESSION["classID"] = $classID;
    }
    else {
        $_SESSION["attendanceExistError"] = "<b>Invalid Class ID attempted.</b>";
        redirectsToPreviousPage();
    }
}

function antiExploit($str) {
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}

function redirectsToPreviousPage() {
    header('Location: viewClassAttendance.php');
    die();
}
?>

