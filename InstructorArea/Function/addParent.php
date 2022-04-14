<?php

/* 
 * =====================================================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * =====================================================================
 * 
 * @author Tang Khai Li
 */

require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/Parents.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/Address.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/ParentDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/AddressDB.php";


if (isset($_POST["submitBtn"])){
    $submitButton = true;
    //Put empty validations here
    $parentName = eliminateExploit($_POST["parentName"]);
    $parentGender = eliminateExploit($_POST["parentGender"]);
    $parentBirthday = eliminateExploit($_POST["parentBirthday"]);
    $parentEmail = eliminateExploit($_POST["parentEmail"]);
    $parentPhoneNumber = eliminateExploit($_POST["parentPhoneNumber"]);
    $parentICNumber = eliminateExploit($_POST["parentICNumber"]);
    $parentType = eliminateExploit($_POST["parentType"]);
    $parentID = "P".generateRandomString();
    $addressID = "A".generateRandomString();
    $address = eliminateExploit($_POST["address"]);
    $city = eliminateExploit($_POST["city"]);
    $state = eliminateExploit($_POST["state"]);
    $postcode = eliminateExploit($_POST["postcode"]);
    $password = eliminateExploit($_POST["password"]);
    $hashedPw = md5($password);
    
    $address = new Address($addressID, $address, $city, $state, $postcode);
    $parent = new Parents(
                $parentID,
                $parentName, 
                $parentGender, 
                $parentBirthday, 
                $parentEmail, 
                $parentPhoneNumber, 
                $parentICNumber, 
                $parentType, 
                $addressID,
                $hashedPw);
    print_r($address);
    print_r($parent);
    $addressDB = new AddressDB();
    $parentDB = new ParentDB();
    
    if ($addressDB->insertNewAddress($address)>0){
        
        if ($parentDB->insert($parent) == true){
            header("location:parent.php");
        }
    }
    
}

function generateRandomString(){
    $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomStr = '';
    
    for ($i = 0; $i < 10; $i++) {
        $index = rand(0, strlen($char) - 1);
        $randomStr .= $char[$index];
    }
    return $randomStr;
}

function eliminateExploit($str){
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}
