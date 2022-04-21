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

if (isset($_POST["submitBtn"])) {
    $submitButton = true;
    //Put empty validations here
    $parentName = eliminateExploit($_POST["parentName"]);
    //$parentGender = eliminateExploit($_POST["parentGender"]);
    $parentBirthday = eliminateExploit($_POST["parentBirthday"]);
    $parentEmail = eliminateExploit($_POST["parentEmail"]);
    $parentPhoneNumber = eliminateExploit($_POST["parentPhoneNumber"]);
    $parentICNumber = eliminateExploit($_POST["parentICNumber"]);
    $parentType = eliminateExploit($_POST["parentType"]);
    $storedValue["parentType"] = $parentType;
    $parentID = "P" . generateRandomString();
    $addressID = "A" . generateRandomString();
    $address = eliminateExploit($_POST["address"]);
    $city = eliminateExploit($_POST["city"]);
    $state = eliminateExploit($_POST["state"]);
    $postcode = eliminateExploit($_POST["postcode"]);
    $password = eliminateExploit($_POST["password"]);
    $hashedPw = md5($password);

    if (empty($parentName)) {
        $error["parentName"] = "Please enter parent name";
    }else{
        $storedValue["parentName"] = $parentName;
    }

    if (empty($_POST["parentGender"])) {
        $error["parentGender"] = "Please enter parent gender";
    }else{
        $parentGender = eliminateExploit($_POST["parentGender"]);
        $storedValue["parentGender"] = $parentGender;
    }

    if (empty($parentBirthday)) {
        $error["parentBirthday"] = "Please select parent birthday";
    }else{
        $storedValue["parentBirthday"] = $parentBirthday;
    }

    $db = new ParentDB();
    if (empty($parentEmail)) {
        $error["parentEmail"] = "Please enter parent email";
    } else if (!filter_var($_POST["parentEmail"], FILTER_VALIDATE_EMAIL)) {
        $error["parentEmail"] = "User email doesn't have the correct format. Please re-enter!";
        $storedValue["parentEmail"] = $parentEmail;
    } else if ($db->checkEmail(trim($_POST["parentEmail"]))) {
        $error["parentEmail"] = "The email had already been used. Please enter another email!";
        $storedValue["parentEmail"] = $parentEmail;
    } else {
        $parentEmail = trim($_POST["parentEmail"]);
        $storedValue["parentEmail"] = $parentEmail;
    }

    if (empty($parentPhoneNumber)) {
        $error["parentPhoneNumber"] = "Please enter parent phone number";
    }else if(!preg_match( '/[0-9]{3}-[0-9]{7,9}/',$_POST["parentPhoneNumber"])){
        $error["parentPhoneNumber"] = "Phone number format should be xxx-xxxxxxx";
        $storedValue["parentPhoneNumber"] = $parentPhoneNumber;
    }else{
        $storedValue["parentPhoneNumber"] = $parentPhoneNumber;
    }

    if (empty($parentICNumber)) {
        $error["parentICNumber"] = "Please enter parent IC number";
    }else if(!preg_match('/[0-9]{6}-[0-9]{2}-[0-9]{4}/',$_POST["parentICNumber"] )){
        $error["parentICNumber"] = "IC number formate should be xxxxxx-xx-xxxx";
        $storedValue["parentICNumber"] = $parentICNumber;
    }else{
        $storedValue["parentICNumber"] = $parentICNumber;
    }

    if (empty($address)) {
        $error["address"] = "Please enter parent address";
    }else{
        $storedValue["address"] = $address;
    }

    if (empty($city)) {
        $error["city"] = "Please enter city";
    }else{
        $storedValue["city"] = $city;
    }

    if (empty($state)) {
        $error["state"] = "Please enter state";
    }else{
        $storedValue["state"] = $state;
    }

    if (empty($postcode)) {
        $error["postcode"] = "Please enter postcode";
    }else if(!preg_match( '/[0-9]{5}/',$_POST["postcode"])){
        $error["postcode"] = "postcode will only accept five digit number";
        $storedValue["postcode"] = $postcode;
    }else{
        $storedValue["postcode"] = $postcode;
    }

    if (empty($password)) {
        $error["password"] = "Please enter password";
    } else if (!(strlen($_POST["password"]) < 60)) {
        $error["password"] = "Password can not more than 60 characters.";
        $storedValue["password"] = $password;
    } else {
        $password = ($_POST["password"]);
        $storedValue["password"] = $password;
    }

    if (empty($error)) {
        $address = new Address($addressID, $address, $city, $state, $postcode);
        $parent = new Parents(
                $parentID,
                $parentName,
                substr($parentGender, 0, 1),
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

        if ($addressDB->insertNewAddress($address) > 0) {

            if ($parentDB->insert($parent) == true) {
                header("location:parent.php");
            }
        }
    }
}

function generateRandomString() {
    $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomStr = '';

    for ($i = 0; $i < 10; $i++) {
        $index = rand(0, strlen($char) - 1);
        $randomStr .= $char[$index];
    }
    return $randomStr;
}

function eliminateExploit($str) {
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}
