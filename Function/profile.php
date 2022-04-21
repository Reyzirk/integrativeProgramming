<?php
require_once dirname(__DIR__)."/Objects/Parents.php";
require_once dirname(__DIR__)."/Objects/Address.php";
require_once dirname(__DIR__)."/Database/ParentDB.php";
require_once dirname(__DIR__)."/Database/AddressDB.php";
 $valid = true;
if(isset($_SESSION["parentID"])){
    $parentdb = new ParentDB();
    $result = $parentdb->details($_SESSION["parentID"]);
    $oldID = $result->userID;
    $parentEmail=$result->email;
    $parentType=$result->parentType;
    $parentGender=$result->gender;
    $parentBirth=$result->birthDate;
    $parentPhoneNo = $result->contactNumber;
    $parentICNo = $result->icNo;
    $addressdb = new AddressDB();
    $result2 = $addressdb->details($result->addressID);
    $address = $result2->address;
    $city = $result2->city;
    $state = $result2->state;
    $postCode = $result2->postcode;
    $parentName = $result->name;
    
}
 if($_SERVER["REQUEST_METHOD"] == "POST")
 {
     //Check whether this email is existing in the database or not if yes show error message
     $db = new ParentDB();
     //check validation of user ID
    
    if (empty($_POST["parentType"])){
        $parentType_err = "Please select a parent type";
        $valid = false;
    }else{
        $parentType = $_POST["parentType"];
    }
    
    if (empty($_POST["parentGender"])){
        $parentGender_err = "Please select a gender";
        $valid = false;
    }else{
        $parentGender = $_POST["parentGender"];
    }
    
    if (empty($_POST["parentBirth"])){
        $parentBirth_err = "Please type the birthdate";
        $valid = false;
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
    }else if(!preg_match( '/^[0-9]{5}$/',$_POST["PostCode"])){
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
        $addressID = uniqid("A",true);
        $address = new Address($addressID, $address, $city, $state, $postCode);
        $parent = new Parents("",$parentName,$parentGender, $parentBirth, "", $parentPhoneNo, $parentICNo, $parentType, $addressID, "");
        $addressdb = new AddressDB();
        $addressdb->insertNewAddress($address);
        $parentdb = new ParentDB();
        $parentdb->updateParentSide($oldID, $parent);
        $_SESSION["successUpdate"] = "profile";
        header("location: announcement.php");
        
    }
 }
 ?>
