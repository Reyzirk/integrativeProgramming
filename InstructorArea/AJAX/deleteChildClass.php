<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of deleteChildClass
 *
 * @author Choo Meng
 */
require_once "AJAXErrorHandler.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ChildClassDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/ChildClass.php";
if (empty($_POST["classID"])||empty($_POST["childID"])){
    echo "fail";
}else{
    $classid = eliminateExploit($_POST["classID"]);
    $childid = eliminateExploit($_POST["childID"]);
    $childclass = new ChildClass($childid,$classid);
    try{
        $childclassdb = new ChildClassDB();
        if ($childclassdb->delete($childclass)){
            echo "success";
        }else{
            echo "The child is not assigned to this class.";
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
