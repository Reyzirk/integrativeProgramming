<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * @author Oon Kheng Huang
 */

$instructorID = $_SESSION["instructorID"];

if (empty($_GET["id"])) {
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: announcement.php');
}
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/Announcement.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/AnnouncementDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/Parents.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/ParentDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/Attachment.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/AttachmentDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/InstructorDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/Instructor.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/AnnounceWithDoc.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/AnnounceWithImg.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/AnnounceWithImgDoc.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/AnnounceWithNoAttach.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/InstructorsAnnounceDecorator.php";
require_once dirname(__DIR__) . "/Function/AttachmentFactory.php";

$announceDB = new AnnouncementDB();
$attachDB = new AttachmentDB();
$id = $_GET["id"];
$getAnnounce = $announceDB->details($id);
$attachCount = $attachDB->getCountByAID($id);
$attachList = array();

$announceInfo;

//****************Implementation of Attachment Factory******************
if (empty($getAnnounce)) {
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: announcement.php');
} else {

    if ($attachCount == 0) {
        $announceInfo = AttachmentFactory::createAnnounceType($getAnnounce);
    } else if ($attachCount > 0) {
        $attachList = $attachDB->details($id);
        $announceInfo = AttachmentFactory::createAnnounceType($getAnnounce, $attachList);
    }
}

//***********Convert Category Char to String***************
function convertCatToWord($cat) {
    switch ($cat) {
        case 'A':
            return "Activity";
            break;
        case 'C':
            return "Covid-19";
            break;
        case 'E':
            return "Examination";
            break;
        case 'H':
            return "Homework";
            break;
        case 'N':
            return "Notice";
            break;
        case 'T':
            return "Tuition";
            break;
        case 'W':
            return "News";
            break;
    }
}


