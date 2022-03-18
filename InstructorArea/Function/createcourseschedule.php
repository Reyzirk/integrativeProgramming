<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of createexamination
 *
 * @author Choo Meng
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/CourseSchedule.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/CourseScheduleDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/InstructorDB.php";
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/XML/ParserFactory.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ClassDB.php";
if (empty($_GET["id"])){
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: classes.php');
}else{
    $id = $_GET["id"];
    $classDB = new ClassDB();
    if (!$classDB->validID($id)){
        $_SESSION["errorLog"] = "noid";
        header('HTTP/1.1 307 Temporary Redirect');
        header('Location: classes.php');
    }
}
$factory = new ParserFactory();
$parser = $factory->getParser("Courses");
$arrayDayofWeek = array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
$arrayType = array("Lecture","Tutorial","Practical","Blended");
if (isset($_POST["formDetect"])){
    $inputName = "courseCode";
    $inputTitle = "Course Code";
    if (empty($_POST[$inputName])){
        $error[$inputName] = "<b>$inputTitle</b> cannot empty.";
    }else{
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
        if (strlen($storedValue[$inputName])>10){
            $error[$inputName] = "<b>$inputTitle</b> cannot more than 10 characters.";
        }else if(!$parser->checkExist($storedValue[$inputName])){
            $error[$inputName] = "<b>$inputTitle</b> is not exist.";
        }
    }
    $inputName = "instructor";
    $inputTitle = "Examiner";
    if (empty($_POST[$inputName])){
        $error[$inputName] = "<b>$inputTitle</b> cannot empty.";
    }else{
        try{
            $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
            $instructorDB = new InstructorDB();
            if (!$instructorDB->validID($storedValue[$inputName])){
                $error[$inputName] = "<b>$inputTitle</b> invalid Instructor ID.";
            }
        } catch (Exception $ex) {
            $error[$inputName] = "<b>$inputTitle</b> database error.";
        }
    }
    $inputName = "timeStart";
    $inputTitle = "Time Start";
    if (empty($_POST[$inputName])){
        $error[$inputName] = "<b>$inputTitle</b> cannot empty.";
    }else{
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
        $datetime = DateTime::createFromFormat("H:i", $storedValue[$inputName]);
        if ($datetime==false){
            $error[$inputName] = "<b>$inputTitle</b> invalid type.";
        }else{
            $min = intval($datetime->format("i"));
            if ($min%30!=0){
                $error[$inputName] = "<b>$inputTitle</b> must 0 minute or 30 minutes only.";
            }
        }
    }
    $inputName = "duration";
    $inputTitle = "Duration";
    if (empty($_POST[$inputName])){
        $error[$inputName] = "<b>$inputTitle</b> cannot empty.";
    }else{
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
        try{
            $storedValue[$inputName] = $duration = intval($storedValue[$inputName]);
            if ($duration < 1 || $duration > 6000){
                $error[$inputName] = "<b>$inputTitle</b> must between 1 to 6000.";
            }else if ($duration%30!=0){
                $error[$inputName] = "<b>$inputTitle</b> must be time of 30 minutes.";
            }
        } catch (Exception $ex) {
            $error[$inputName] = "<b>$inputTitle</b> must number.";
        }
    }
    $inputName = "dayOfWeek";
    $inputTitle = "Day of Week";
    if (empty($_POST[$inputName])){
        $error[$inputName] = "<b>$inputTitle</b> cannot empty.";
    }else{
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
        if (!in_array($storedValue[$inputName], $arrayDayofWeek)){
            $error[$inputName] = "<b>$inputTitle</b>  not valid option.";
        }
    }
    $inputName = "classType";
    $inputTitle = "Class Type";
    if (empty($_POST[$inputName])){
        $error[$inputName] = "<b>$inputTitle</b> cannot empty.";
    }else{
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
        if (!in_array($storedValue[$inputName], $arrayType)){
            $error[$inputName] = "<b>$inputTitle</b>  not valid option.";
        }
    }
    if (empty($error)){
        $newSchedule = new CourseSchedule(uniqid("s", true),$storedValue["courseCode"],$id,$storedValue["instructor"],$storedValue["timeStart"],$storedValue["duration"],$storedValue["classType"],$storedValue["dayOfWeek"]);

        $scheduleDB = new CourseScheduleDB();
        if ($scheduleDB->insert($newSchedule)){
            $_SESSION["modifyLog"] = "createcourseschedule";
            header('HTTP/1.1 307 Temporary Redirect');
            header('Location: courseschedule.php?id='.$id);
        }else{
            $_SESSION["errorLog"] = "sqlerror";
        }
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
