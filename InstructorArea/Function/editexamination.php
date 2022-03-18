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
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/Examination.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ExaminationDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/InstructorDB.php";
if (empty($_GET["id"])){
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: examinations.php');
}else{
    $id = $_GET["id"];
    $examDB = new ExaminationDB();
    $retrievedExam = $examDB->details($id);
    if (!empty($retrievedExam)){
        $storedValue["examinationID"] = $id;
        $storedValue["courseCode"] = $retrievedExam->course;
        $storedValue["instructor"] = $retrievedExam->examiner;
        $datetime = new DateTime($retrievedExam->examStartTime);
        $storedValue["examStartTime"] = $datetime->format("Y-m-d\TH:i");
        $storedValue["examDuration"] = $retrievedExam->examDuration;
    }else{
        $_SESSION["errorLog"] = "noid";
        header('HTTP/1.1 307 Temporary Redirect');
        header('Location: examinations.php');
    }
}
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/XML/ParserFactory.php';
$factory = new ParserFactory();
$parser = $factory->getParser("Courses");
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
    $inputName = "examStartTime";
    $inputTitle = "Exam Start Time";
    if (empty($_POST[$inputName])){
        $error[$inputName] = "<b>$inputTitle</b> cannot empty.";
    }else{
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
        if (DateTime::createFromFormat("Y-m-d\TH:i", $storedValue[$inputName])==false){
            $error[$inputName] = "<b>$inputTitle</b> invalid type.";
        }
    }
    $inputName = "examDuration";
    $inputTitle = "Exam Duration";
    if (empty($_POST[$inputName])){
        $error[$inputName] = "<b>$inputTitle</b> cannot empty.";
    }else{
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
        try{
            $storedValue[$inputName] = $duration = intval($storedValue[$inputName]);
            if ($duration < 1 || $duration> 60000){
                $error[$inputName] = "<b>$inputTitle</b> must between 1 to 60000.";
            }
        } catch (Exception $ex) {
            $error[$inputName] = "<b>$inputTitle</b> must number.";
        }
    }
    if (empty($error)){
        $newExamination = new Examination(uniqid("E", true),$storedValue["courseCode"],$storedValue["instructor"],$storedValue["examStartTime"],$storedValue["examDuration"]);
        
        $examinationDB = new ExaminationDB();
        if ($examinationDB->update($id,$newExamination)){
            $_SESSION["modifyLog"] = "createexamination";
            header('HTTP/1.1 307 Temporary Redirect');
            header('Location: examinations.php');
        }
    }
}
function eliminateExploit($str){
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}
