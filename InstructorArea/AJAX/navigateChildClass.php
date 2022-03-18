<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ClassDB.php";
if (empty($_POST["classID"])){
    echo "fail";
}else{
    $classid = eliminateExploit($_POST["classID"]);
    try{
        $classdb = new ClassDB();
        if ($classdb->validID($classid)){
            echo "success";
        }else{
            echo "Unable to find the class by using the Class ID given.";
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