<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ClassDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/CourseScheduleDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/CourseSchedule.php";
$dataArray = array(
    "name" =>
    array(
        "Title" => "Holiday",
        "Width" => "60%"),
    "startDate" =>
    array(
        "Title" => "Date",
        "Width" => "30%"));
if (empty($_GET["id"])){
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: timetableclasses.php');
}else{
    $id = $_GET["id"];
    $classDB = new ClassDB();
    if (!$classDB->validID($id)){
        $_SESSION["errorLog"] = "noid";
        header('HTTP/1.1 307 Temporary Redirect');
        header('Location: timetableclasses.php');
    }else{
        if (!$classDB->access($_SESSION["childID"],$id)){
            $_SESSION["errorLog"] = "noaccess";
            header('HTTP/1.1 307 Temporary Redirect');
            header('Location: timetableclasses.php');
        }
    }
}
$scheduledb = new CourseScheduleDB();
$result = $scheduledb->list($id);
$scheduleList = array();
if ($result!=NULL){
    foreach ($result as $row){
        $dow = $row["Day"];
        $schedule = new CourseSchedule($row["ScheduleID"],$row["CourseCode"],$row["ClassID"],$row["InstructorName"],$row["TimeStart"],$row["Duration"],$row["ClassType"],$row["Day"]);
        $scheduleList[$dow][] = $schedule;
    }
    require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/ParserFactory.php';
    $factory = new ParserFactory();
    $parser2 = $factory->getParser("Courses");
}
function convertMinute($val){
    $timeStr = "";
    if ($val>=1440){
        $days = (int)($val/1440);
        $timeStr .= $days.($days>1?" days":" day")." ";
        $val = $val%1440;
    }
    if ($val>=60){
        $hours = (int)($val/60);
        $timeStr = $timeStr.$hours.($hours>1?" hours":" hour")." ";
        $val = $val%60;
    }
    if ($val >= 1){
        $timeStr = $timeStr.$val.($val>1?" minutes":" minute")." ";
    }
    $timeStr = trim($timeStr);
    return $timeStr;
}