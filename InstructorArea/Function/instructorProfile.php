<?php
/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/Instructor.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/InstructorDB.php";

$instructorID = $_SESSION["instructorID"];

$instructorDB = new InstructorDB();
$getInstructor = $instructorDB->details($instructorID);

if (!empty($getInstructor)) {
    $storedValue["instructID"] = $getInstructor->userID;
    $storedValue["name"] = $getInstructor->name;
    $storedValue["employDate"] = $getInstructor->employeeDate;
    $storedValue["gender"] = $getInstructor->gender;
    $storedValue["birthDate"] = $getInstructor->birthDate;
    $storedValue["email"] = $getInstructor->email;
    $storedValue["contact"] = $getInstructor->contactNumber;
    $storedValue["icNo"] = $getInstructor->icNo;
}

if (isset($_POST["formDetect"])) {

    //***************************Name Validation************************************
    $inputName = "name";
    $inputTitle = "Name";
    if (empty($_POST[$inputName])) {
        $error[$inputName] = "<b>$inputTitle</b> cannot be empty.";
    } else {
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
        if (strlen($storedValue[$inputName]) > 300) {
            $error[$inputName] = "<b>$inputTitle</b> cannot contain more than 300 characters";
        }
    }

    //***************************Email Validation************************************ 
    $inputName = "email";
    $inputTitle = "Email";
    if (empty($_POST[$inputName])) {
        $error[$inputName] = "<b>$inputTitle</b> cannot empty.";
    } else if(!filter_var($_POST["parentEmail"], FILTER_VALIDATE_EMAIL)){
        $error[$inputName] = "<b>$inputTitle</b> format is not correct. e.g.: abc@gmail.com";
    }else{
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
    }

    //***************************Contact Number Validation************************************ 
    $inputName = "contact";
    $inputTitle = "Contact Number";
    if (empty($_POST[$inputName])) {
        $error[$inputName] = "<b>$inputTitle</b> cannot empty.";
    } else if(!preg_match( '/[0-9]{3}-[0-9]{7,9}/',$_POST["parentPhoneNo"])){
        $error[$inputName] = "<b>$inputTitle</b> format is incorrect. e.g.: xxx-xxxxxxx";
    }else{
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
    }

    //***************************Gender Validation************************************
    $inputName = "gender";
    $inputTitle = "Gender";
    if (empty($_POST[$inputName])) {
        $error[$inputName] = "<b>$inputTitle</b> is not selected";
    } else {
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
    }

    //***************************Connect Database************************************
    if (empty($error)) {

        $instruct = new Instructor($storedValue["instructID"], 
                $storedValue["name"], 
                $storedValue["employDate"], 
                $storedValue["gender"], 
                $storedValue["birthDate"],
                $storedValue["email"], 
                $storedValue["contact"], 
                $storedValue["icNo"], 
                $getInstructor->password);
        
        $instructorDB = new InstructorDB();

        if ($instructorDB->update($storedValue["instructID"], $instruct)) {
            $_SESSION["modifyLog"] = "editinstructorprofile";

            header('HTTP/1.1 307 Temporary Redirect');
            header('Location: announcement.php');//<--------------------------------------------Redirect
        } else {
            $_SESSION["errorLog"] = "sqlerror";
        }

        if (!empty($_SESSION["errorLog"])) {

            if ($_SESSION["errorLog"] == "sqlerror1") {
                $successMsg = "Database error. Please try again1!";
            }
            ?>
            <script>
                setTimeout(function () {
                    Toast.fire({
                        icon: 'success',
                        html: '<b>Sucessful</b><br/><?php echo $successMsg; ?>.'
                    })
                }, 1500);
            </script>
            <?php
            unset($_SESSION["errorLog"]);
        }
    }
}

//***************************Trim the variable************************************
function eliminateExploit($str) {
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}
