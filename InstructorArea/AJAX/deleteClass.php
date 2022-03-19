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
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ClassDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/HomeworkDB.php";
if (empty($_POST["classID"])){
    echo "fail";
}else{
    $id = eliminateExploit($_POST["classID"]);
    try{
         $classdb = new ClassDB();
        if ($classdb->delete($id)){
            echo "success";
        }else{
            echo "Unable to find the Class.";
        }
    } catch (PDOException $ex) {
        $errorInfo = $ex->errorInfo;
        $errorCode = $errorInfo[1];
        if ($errorCode == "1451"){
            echo "Required to reassign the student that under this class or delete all the homework.";
        }else{
            if ($generalSection["maintenance"]==true){
                echo $ex->getMessage();
            }else{
                callPDOExceptionLog($ex);
            }
        }
        
    }
   
    
}
function eliminateExploit($str){
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}