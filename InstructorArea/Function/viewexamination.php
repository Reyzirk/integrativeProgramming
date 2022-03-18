<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of viewexamination
 *
 * @author Choo Meng
 */
if (empty($_GET["id"])){
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: examinations.php');
}
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/Examination.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ExaminationDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/Instructor.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/InstructorDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/Course.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/ParserFactory.php';
$factory = new ParserFactory();
$parser = $factory->getParser("Courses");
$examdb = new ExaminationDB();
$id = $_GET["id"];
$retrievedExam = $examdb->details($id);
if (empty($retrievedExam)){
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: examinations.php');
}

$instructordb = new InstructorDB();
$retrievedInstructor = $instructordb->details($retrievedExam->examiner);
$retrievedCourse = $parser->getCourse($retrievedExam->course);
$endtime = new DateTime($retrievedExam->examStartTime);
$endtime->add(new DateInterval('PT' . $retrievedExam->examDuration . 'M'));
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
