<?php
//Author: Poh Choo Meng
/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
require_once "AJAXErrorHandler.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ExamResultDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ClassDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ChildClassDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/ExamResult.php";

if (empty($_POST["classID"])||empty($_POST["examID"])){
    echo "fail";
}else{
    $id = eliminateExploit($_POST["classID"]);
    $examid = eliminateExploit($_POST["examID"]);
    try{
        $classdb = new ClassDB();
        if ($classdb->validID($id)){
            $childclassdb = new ChildClassDB();
            $results = $childclassdb->list($id);
            $index = 0;
            foreach($results as $row){
                $resultdb = new ExamResultDB();
                $examresult = new ExamResult($examid,$row["ChildID"],0);
                if (!$resultdb->validID($examresult)){
                    $resultdb->insert($examresult);
                    $index++;
                }
            }
            if ($index==0){
                echo "The student that under this class already assigned to this examination.";
            }else{
                echo "success";
            }
        }else{
            echo "Unable to find the class by using the class ID given.";
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
