<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
if (empty($_GET["id"])){
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: holidays.php');
}
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/Holiday.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/ParserFactory.php';
$factory = new ParserFactory();
$parser = $factory->getParser("Holidays");
if (empty($_GET["id"])){
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: holidays.php');
}else{
    $id = $_GET["id"];
    $retrievedHoliday = $parser->getHoliday($id);
    if (!empty($retrievedHoliday)){
        $storedValue["holidayName"] = $retrievedHoliday->name;
        $storedValue["dateStart"] = $retrievedHoliday->dateStart;
        $storedValue["dateEnd"] = $retrievedHoliday->dateEnd;
    }else{
        $_SESSION["errorLog"] = "noid";
        header('HTTP/1.1 307 Temporary Redirect');
        header('Location: holidays.php');
    }
}

if (isset($_POST["formDetect"])){
    
    if (empty($_POST["holidayName"])){
        $error["holidayName"] = "<b>Holiday Name</b> cannot empty.";
    }else{
        $storedValue["holidayName"] = eliminateExploit($_POST["holidayName"]);
        if (strlen($storedValue["holidayName"])>300){
            $error["holidayName"] = "<b>Holiday Name</b> cannot more than 300 characters.";
        }
    }
    if (empty($_POST["dateStart"])){
        $error["dateStart"] = "<b>Start Date</b> cannot empty.";
    }else{
        $storedValue["dateStart"] = eliminateExploit($_POST["dateStart"]);
        try{
            $date = date_parse_from_format("Y-m-d", $storedValue["dateStart"]);
            if (!checkdate($date["month"], $date["day"], $date["year"])){
                $error["dateStart"] = "<b>Start Date</b> invalid date.";
            }
        } catch (Exception $ex) {
            $error["dateStart"] = "<b>Start Date</b> invalid date.";
        }
    }
    if (empty($_POST["dateEnd"])){
        $error["dateEnd"] = "<b>End Date</b> cannot empty.";
    }else{
        $storedValue["dateEnd"] = eliminateExploit($_POST["dateEnd"]);
        try{
            $date = date_parse_from_format("Y-m-d", $storedValue["dateEnd"]);
            if (!checkdate($date["month"], $date["day"], $date["year"])){
                $error["dateEnd"] = "<b>End Date</b> invalid date.";
            }
        } catch (Exception $ex) {
            $error["dateEnd"] = "<b>End Date</b> invalid date.";
        }
    }
    if (empty($error)){
        $newHoliday = new Holiday($id,$storedValue["holidayName"],$storedValue["dateStart"],$storedValue["dateEnd"]);
        require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/ParserFactory.php';
        $factory = new ParserFactory();
        $parser = $factory->getParser("Holidays");
        $parser->updateHoliday($newHoliday);
        $factory->saveXML("Holidays");
        $_SESSION["modifyLog"] = "editholiday";
        header('HTTP/1.1 307 Temporary Redirect');
        header('Location: holidays.php');
        
    }
}
function eliminateExploit($str){
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}