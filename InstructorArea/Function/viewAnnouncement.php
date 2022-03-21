<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * @author Oon Kheng Huang
 */

if (empty($_GET["id"])){
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: announcement.php');
}
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/Announcement.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/AnnouncementDB.php";
$announceDB = new AnnouncementDB();
$id = $_GET["id"];
$getAnnounce = $announceDB->details($id);
if (empty($getAnnounce)){
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: announcement.php');
}

//***********Convert Category Char to String***************
function convertCatToWord($cat){
    switch($cat){
        case 'A':
            return "Activity";break;
        case 'C':
            return "Covid-19";break;
        case 'E':
            return "Examination";break;
        case 'H':
            return "Homework";break;
        case 'N':
            return "Notice";break;
        case 'T':
            return "Tuition";break;
        case 'W':
            return "News";break;
    }
} 