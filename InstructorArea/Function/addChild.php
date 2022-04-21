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
    $submitButton = true;
    //Put empty validations
    $parentID = eliminateExploit($_GET["parentID"]);
    $childID = "C".generateRandomString();
    $childName = eliminateExploit($_POST["childName"]);
    $childBirthdate = eliminateExploit($_POST["childBirthDate"]);
    $childIC = eliminateExploit($_POST["childIC"]);
    $childStatus = eliminateExploit($_POST["childStatus"]);
    
    if (empty($childName)) {
        $error["childName"] = "Please enter child name";
    }else{
        $storedValue["childName"] = $childName;
    }
    
     if (empty($childBirthDate)) {
        $error["childBirthDate"] = "Please select child birthday";
    }else{
        $storedValue["childBirthDate"] = $childBirthDate;
    }
    
    if (empty($childIC)) {
        $error["childIC"] = "Please enter child IC number";
    }else if(!preg_match('/[0-9]{6}-[0-9]{2}-[0-9]{4}/',$_POST["childIC"] )){
        $error["childIC"] = "IC number format should be xxxxxx-xx-xxxx";
        $storedValue["childIC"] = $childIC;
    }else{
        $storedValue["childIC"] = $childIC;
    }
    
    if (empty($error)){
        $child = new Child(
                $childID,
                $parentID,
                $childName,
                $childBirthDate,
                $childIC,
                $childStatus);
        print_r($child);
        $childDB = new ChildDB();
        
         if ($childDB->insertChildRecords($child) == true){
            header("location:parent.php");
        }
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