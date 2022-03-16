<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of deleteHomework
 *
 * @author Choo Meng
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/HomeworkDB.php";
if (empty($_POST["homeworkID"])){
    echo "fail";
}else{
    $id = eliminateExploit($_POST["homeworkID"]);
    try{
        $homeworkdb = new HomeworkDB();
        if ($homeworkdb->delete($id)){
            echo "success";
        }else{
            echo "Unable to find the Homework.";
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