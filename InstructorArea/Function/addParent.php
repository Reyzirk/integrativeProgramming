<?php

/* 
 * =====================================================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * =====================================================================
 * 
 * @author Tang Khai Li
 */

require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/Parent.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/ParentDB.php";


if (isset($_POST["submitBtn"])){
    $submitButton = true;
    $parentName = eliminateExploit($_POST["parentName"]);
    $parentGender = eliminateExploit($_POST("parentGender"));
    $parentBirthday = eliminateExploit($_POST["parentBirthday"]);
    $parentEmail = eliminateExploit($_POST["parentEmail"]);
    $parentPhoneNumber = eliminateExploit($_POST["parentPhoneNumber"]);
    $parentICNumber = eliminateExploit($_POST["parentICNumber"]);
    $parentType = eliminateExploit($_POST["parentType"]);
    $parentAddress = eliminateExploit($_POST["parentAddress"]);
}

function eliminateExploit($str){
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}
