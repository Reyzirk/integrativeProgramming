<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of edithomework
 *
 * @author Choo Meng
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/Homework.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/HomeworkDB.php";
if (empty($_GET["id"])){
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: classes.php');
}else{
    $id = $_GET["id"];
    $homeworkDB = new HomeworkDB();
    $retrievedHomework = $homeworkDB->details($id);
    $oldDate;
    if (!empty($retrievedHomework)){
        $storedValue["classID"] = $retrievedHomework->class;
        $oldDate = $storedValue["date"] = $retrievedHomework->date;
        $storedValue["homework"] = $retrievedHomework->homework;
    }else{
        $_SESSION["errorLog"] = "noid";
        header('HTTP/1.1 307 Temporary Redirect');
        header('Location: classes.php');
    }
}
if (isset($_POST["formDetect"])){
    $inputName = "date";
    $inputTitle = "Date";
    if (empty($_POST[$inputName])){
        $error[$inputName] = "<b>$inputTitle</b> cannot empty.";
    }else{
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
        $homeworkdb = new HomeworkDB();
        if (!checkdate(substr($storedValue[$inputName],5,2), substr($storedValue[$inputName],8,2), substr($storedValue[$inputName],0,4))){
            $error[$inputName] = "<b>$inputTitle</b> invalid.";
        }else if ($oldDate != $storedValue[$inputName]){
            if ($homeworkdb->dateExist($storedValue[$inputName])){
                $error[$inputName] = "<b>$inputTitle</b> already exist.";
            }
            
        }
    }
    $inputName = "homework";
    $inputTitle = "Homework";
    if (empty($_POST[$inputName])){
        $error[$inputName] = "<b>$inputTitle</b> cannot empty.";
    }else{
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
        
        if (strlen($storedValue[$inputName])>999999){
            $error[$inputName] = "<b>$inputTitle</b> reach the character limit.";
        }
    }
    if (empty($error)){
        $newHomework = new Homework($id,$storedValue["classID"],$storedValue["date"],$storedValue["homework"]);
        $homeworkDB = new HomeworkDB();
        if ($homeworkDB->update($id,$newHomework)){
            $_SESSION["modifyLog"] = "edithomework";
            header('HTTP/1.1 307 Temporary Redirect');
            header('Location: homeworks.php?id='.$storedValue["classID"]);
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