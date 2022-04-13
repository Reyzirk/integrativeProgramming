<?php
$apiKey = "d61a42d239989eb9df075a70b5ad0e1435f7b186";
/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
require_once str_replace("InstructorArea", "", str_replace("Demo", "", dirname(__DIR__)))."/Objects/Holiday.php";
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
        $newHoliday = new Holiday("H",$storedValue["holidayName"],$storedValue["dateStart"],$storedValue["dateEnd"]);
        $name = $newHoliday->name;
        $datestart = $newHoliday->dateStart;
        $dateend = $newHoliday->dateEnd;
        $page = file_get_contents("http://localhost/IPAssignment/cmapi.php/holiday/create?api-key=$apiKey&name=$name&start=$datestart&end=$dateend");
        $jsonStr = json_decode($page)[0];
        if ($jsonStr->Status=="Success"){
            header('HTTP/1.1 307 Temporary Redirect');
            header('Location: holidaylist.php');
        }
        
    }
}
function eliminateExploit($str){
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}