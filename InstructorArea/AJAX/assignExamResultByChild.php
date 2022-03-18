<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ExamResultDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ChildDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/ExamResult.php";
if (empty($_POST["childID"])||empty($_POST["examID"])){
    echo "fail";
}else{
    $id = eliminateExploit($_POST["childID"]);
    $examid = eliminateExploit($_POST["examID"]);
    try{
        $childdb = new ChildDB();
        if ($childdb->validID($id)){
            $resultdb = new ExamResultDB();
            $examresult = new ExamResult($examid,$id,0);
            if ($resultdb->validID($examresult)){
                echo "The child already assigned to this examination.";
            }else{
                $resultdb->insert($examresult);
                echo "success";
            }
        }else{
            echo "Unable to find the child by using the child ID given.";
        }
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        
    }
   
    
}
function eliminateExploit($str){
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}
