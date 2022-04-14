<?php
/* 
 * =====================================================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * =====================================================================
 * 
 * @author Tang Khai Li
 */


require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/Child.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/ChildClass.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/ChildDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/ChildClassDB.php";


if (isset($_POST["submitBtn"])){
    
    //Put empty validations
    $parentID = eliminateExploit($_GET["parentID"]);
    $childID = "C".generateRandomString();
    $childName = eliminateExploit($_POST["childName"]);
    $childBirthdate = eliminateExploit($_POST["childBirthDate"]);
    $childIC = eliminateExploit($_POST["childIC"]);
    $childStatus = eliminateExploit($_POST["childStatus"]);
    
    $child = new Child($childID, $parentID, $childName, $childBirthdate, $childIC, $childStatus);
    $childDB = new ChildDB();
    
    if ($childDB->insertChildRecords($child) == true){
        header("location:parent.php");
    }
}

function eliminateExploit($str){
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}

function generateRandomString(){
    $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomStr = '';
    
    for ($i = 0; $i < 5; $i++) {
        $index = rand(0, strlen($char) - 1);
        $randomStr .= $char[$index];
    }
    return $randomStr;
}

?>