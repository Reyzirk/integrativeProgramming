<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * @author Oon Kheng Huang
 */

require_once "AJAXErrorHandler.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/AnnouncementDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/AttachmentDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/CommentDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/ReadStatusDB.php";

if (empty($_POST["announceID"])) {
    echo "fail";
} else {
    $id = eliminateExploit($_POST["announceID"]);
    try {
        $announceDB = new AnnouncementDB();
        $attachDB = new AttachmentDB();
        $commentDB = new CommentDB();
        $readDB = new ReadStatusDB();
        $numrow = $attachDB->getCountByAID($id);
        $numrowComment = $commentDB->getCountByAID($id);
        $numrowRead = $readDB->getCountByAID($id);

        if ($numrow == 0 && $numrowComment == 0 && $numrowRead == 0) {
            if ($announceDB->delete($id)) {
                echo "success";
            } else {
                echo "Unable to find the Announcement.";
            }
        } else {
            if ($numrow != 0) {
                $attachDB->delete($id);
            }

            if ($numrowComment != 0) {
                $commentDB->deleteByAnnounceID($id);
            }

            if ($numrowRead != 0) {
                $readDB->deleteByAnnounceID($id);
            }

            if ($announceDB->delete($id)) {
                echo "success";
            } else {
                echo "Unable to find the Announcement.";
            }
        }
    } catch (PDOException $ex) {
        if ($generalSection["maintenance"] == true) {
            echo $ex->getMessage();
        } else {
            callPDOExceptionLog($ex);
        }
    }
}

function eliminateExploit($str) {
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}
