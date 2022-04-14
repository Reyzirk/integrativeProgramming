<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
-->

<!--
@author Shu Ling
 -->
 
<?php
require_once dirname(__DIR__)."/Objects/Parents.php";
require_once dirname(__DIR__)."/Objects/Address.php";
require_once dirname(__DIR__)."/Database/ParentDB.php";
require_once dirname(__DIR__)."/Database/AddressDB.php";
//check if user already logged in
if(isset($_SESSION["parentID"]))
{
    header("location: index.php");
    exit;
}
 $valid = true;
 
 if($_SERVER["REQUEST_METHOD"] == "POST")
 {
     //Check whether this email is existing in the database or not if yes show error message
     $db = new ParentDB();
     //check validation of user ID
     if(empty($_POST["parentEmail"]))
     {
         $parentEmail_err = "Please enter email.";
         $valid = false;
     }else if(!filter_var($_POST["parentEmail"], FILTER_VALIDATE_EMAIL))
     {
         $parentEmail_err = "User email doesn't have the correct format. Please re-enter!";
         $valid = false;
         }else if($db->checkEmail(trim($_POST["parentEmail"]))){
             $parentEmail_err = "The email had already been used. Please enter another email!";
         }else{
         $parentEmail = trim($_POST["parentEmail"]);
         }
     
     //check validation of password
     if(empty($_POST["password"]))
     {
         $password_err = "Please enter password.";
         $valid = false;
     }else if(!(strlen($_POST["password"]) < 60))
     {
         die();
         $password_err = "Password can not more than 60 characters.";
         $valid = false;
     }else
     {
         $password = ($_POST["password"]);
     }
     
     //validate confirm password same with password or not
     if(empty($_POST["confirm_password"])){
        $confirm_password_err = "Please re-enter the password"; 
        $valid = false;
    } else{
        $confirm_password = ($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match, please re-enter.";
            $valid = false;
        }
    }
    
    if (empty($_POST["parentType"])){
        $parentType_err = "Please select a parent type";
    }else{
        $parentType = $_POST["parentType"];
    }
    
    if (empty($_POST["parentGender"])){
        $parentGender_err = "Please select a gender";
    }else{
        $parentGender = $_POST["parentGender"];
    }
    
    if (empty($_POST["parentBirth"])){
        $parentBirth_err = "Please type the birthdate";
    }else{
        $parentBirth = $_POST["parentBirth"];
    }
    
    //validate phone number
    if(empty($_POST["parentPhoneNo"])){
        $parentPhoneNo_err = "Please re-enter the phone number";
        $valid = false;
    }else if(!preg_match( '/[0-9]{3}-[0-9]{7,9}/',$_POST["parentPhoneNo"])){
        $parentPhoneNo_err = "Phone number format should be xxx-xxxxxxx";
        $valid = false;
    }else{
        $parentPhoneNo = $_POST["parentPhoneNo"];
    }
    
    //validate IC number
    if(empty($_POST["parentICNo"])){
        $parentICNo_err = "Please re-enter the IC number";
        $valid = false;
    }else if(!preg_match('/[0-9]{6}-[0-9]{2}-[0-9]{4}/',$_POST["parentICNo"] )){
        $parentICNo_err = "IC number formate should be xxxxxx-xx-xxxx";
        $valid = false;
    }else{
        $parentICNo = $_POST["parentICNo"];
    }
    
    //validate address
    if(empty($_POST["Address"])){
        $address_err = "Please fill in your home address";
        $valid = false;
    }else{
        $address = $_POST["Address"];
    }
    
    //validate City
    if(empty($_POST["City"])){
        $city_err = "Please fill in your city";
        $valid = false;
    }else{
        $city = $_POST["City"];
    }
    
    //validate State
    if(empty($_POST["State"])){
        $state_err = "Please select you state";
        $valid = false;
    }else{
        $state = $_POST["State"];
    }
    
    //validate postcode
    if(empty($_POST["PostCode"])){
        $postCode_err = "Please enter your postcode";
        $valid = false;
    }else if(!preg_match( '/[0-9]{5}/',$_POST["PostCode"])){
        $postCode_err = "postcode will only accept five digit number";
        $valid = false;
    }else{
        $postCode = $_POST["PostCode"];
    }
    
    //validate parent's name
    if(empty($_POST["parentName"])){
        $parentName_err = "Please re-enter your name";
        $valid = false;
    }else{
        $parentName =($_POST["parentName"]);
    }
    if ($valid){
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $addressID = uniqid("A",true);
        $address = new Address($addressID, $address, $city, $state, $postCode);
        $parent = new Parents(uniqid("P", true),$parentName,$parentGender, $parentBirth, $parentEmail, $parentPhoneNo, $parentICNo, $parentType, $addressID, $hashed_password);
        $addressdb = new AddressDB();
        $addressdb->insertNewAddress($address);
        $parentdb = new ParentDB();
        $parentdb->insertNewAccount($parent);
        header("location: login.php");
    }
 }
 ?>