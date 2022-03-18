<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ChildClassDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ChildDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/ChildClass.php";
if (empty($_POST["childID"])||empty($_POST["classID"])){
    echo "fail";
}else{
    $id = eliminateExploit($_POST["childID"]);
    $classid = eliminateExploit($_POST["classID"]);
    try{
        $childdb = new ChildDB();
        if ($childdb->validID($id)){
            $childclassdb = new ChildClassDB();
            $childclass = new ChildClass($id,$classid);
            if ($childclassdb->validID($childclass)){
                echo "The child already assigned to this class.";
            }else{
                $childclass->priority = $childclassdb->getPriority($childclass);
                $childclassdb->insert($childclass);
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
