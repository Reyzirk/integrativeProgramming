<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ChildDB.php";
if (empty($_SESSION["parentID"])){
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: login.php');
}
if (isset($_POST["formDetect"])){
    $inputName = "child";
    $inputTitle = "Child";
    $childdb = new ChildDB();
    
    if (empty($_POST[$inputName])){
        $error[$inputName] = "<b>$inputTitle</b> cannot empty.";
    }else{
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
        if (!$childdb->validID($storedValue[$inputName])){
            $error[$inputName] = "<b>$inputTitle</b> is not exist.";
        }else if (!$childdb->validParent($storedValue[$inputName],$_SESSION["parentID"])){
            $error[$inputName] = "<b>$inputTitle</b> no have access to the child.";
        }
    }
    if (empty($error)){
        $_SESSION['childID'] = $storedValue[$inputName];
        if (empty($_GET["transferpath"])){
            header('HTTP/1.1 307 Temporary Redirect');
            header('Location: timetableclasses.php');
        }else{
            if ($_GET["transferpath"]=="timetable"){
                header('HTTP/1.1 307 Temporary Redirect');
                header('Location: timetableclasses.php');
            }else if ($_GET["transferpath"]=="examination"){
                header('HTTP/1.1 307 Temporary Redirect');
                header('Location: examinationclasses.php');
            }else if ($_GET["transferpath"]=="homework"){
                header('HTTP/1.1 307 Temporary Redirect');
                header('Location: homeworkclasses.php');
            }
        }
    }
}
function eliminateExploit($str){
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}


