<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of deleteClass
 *
 * @author Choo Meng
 */
require_once "AJAXErrorHandler.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/CourseScheduleDB.php";
if (empty($_POST["scheduleID"])){
    echo "fail";
}else{
    $id = eliminateExploit($_POST["scheduleID"]);
    try{
        $scheduledb = new CourseScheduleDB();
        if ($scheduledb->delete($id)){
            echo "success";
        }else{
            echo "Unable to find the schedule.";
        }
    } catch (PDOException $ex) {
        if ($generalSection["maintenance"]==true){
            echo $ex->getMessage();
        }else{
            callPDOExceptionLog($ex);
        }

    }
   
    
}
function eliminateExploit($str){
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}