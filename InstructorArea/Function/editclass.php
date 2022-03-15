<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of editclass
 *
 * @author Choo Meng
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/Classes.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/InstructorDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ClassDB.php";
$id = $_GET["id"];
$classDB = new ClassDB();
$retrievedClass = $classDB->details($id);
if (!empty($retrievedClass)){
    $storedValue["semester"] = $retrievedClass->semester;
    $storedValue["year"] = $retrievedClass->year;
    $storedValue["instructor"] = $retrievedClass->formTeacher;
}else{
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: classes.php');
}
if (isset($_POST["formDetect"])){
    if (empty($_POST["semester"])){
        $error["semester"] = "<b>Semester</b> cannot empty.";
    }else{
        $storedValue["semester"] = eliminateExploit($_POST["semester"]);
        try{
            $storedValue["semester"] = $semester = intval($storedValue["semester"]);
            if ($semester < 0 && $semester > 100){
                $error["semester"] = "<b>Semester</b> must between 0 to 100.";
            }
        } catch (Exception $ex) {
            $error["semester"] = "<b>Semester</b> must number.";
        }
    }
    if (empty($_POST["year"])){
        $error["year"] = "<b>Year</b> cannot empty.";
    }else{
        $storedValue["year"] = eliminateExploit($_POST["year"]);
        try{
            $storedValue["year"] = $year = intval($storedValue["year"]);
            if ($year < 10000 && $semester > 1999){
                $error["year"] = "<b>Year</b> must between 2000 to 9999.";
            }
        } catch (Exception $ex) {
            $error["year"] = "<b>Year</b> must number.";
        }
    }
    if (empty($_POST["instructor"])){
        $error["instructor"] = "<b>Form Teacher</b> cannot empty.";
    }else{
        try{
            $storedValue["instructor"] = eliminateExploit($_POST["instructor"]);
            $instructorDB = new InstructorDB();
            if (!$instructorDB->validID($storedValue["instructor"])){
                $error["instructor"] = "<b>Form Teacher</b> invalid Instructor ID.";
            }
        } catch (Exception $ex) {
            $error["instructor"] = "<b>Form Teacher</b> database error.";
        }
    }
    if (empty($error)){
        $newClass = new Classes($id,$storedValue["semester"],$storedValue["year"],$storedValue["instructor"]);
        $classDB->update($id, $newClass);
        $_SESSION["modifyLog"] = "editclass";
        header('HTTP/1.1 307 Temporary Redirect');
        header('Location: classes.php');
        
    }
}
if (!empty($_SESSION["errorLog"])) {

    if ($_SESSION["errorLog"] == "sqlerror") {
        $successMsg = "Database error. Please try again!";
    }
    ?>
    <script>
        setTimeout(function (){
            Toast.fire({
                icon: 'success',
                html: '<b>Sucessful</b><br/><?php echo $successMsg; ?>.'
            })
        },1500);
    </script>
    <?php
    unset($_SESSION["errorLog"]);
}
function eliminateExploit($str){
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}
