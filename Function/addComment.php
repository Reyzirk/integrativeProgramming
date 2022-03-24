<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * @author Oon Kheng Huang
 */

require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/Announcement.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/AnnouncementDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/Comment.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/CommentDB.php";

if (isset($_POST["commentDetect"])) {
    $id = $_POST["AnnounceID"];
    //***************************Comment Validation************************************
    $inputName = "desc";
    $inputTitle = "Description";

    if (empty(trim($_POST[$inputName]))) {
        $error[$inputName] = "<b>$inputTitle</b> cannot be empty.";
     
    } else {

        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
        if (strlen($storedValue[$inputName]) > 5000) {
            $error[$inputName] = "<b>$inputTitle</b> cannot contain more than 5000 characters";
        }
    }

    //***************************Add Comment************************************
    if (empty($error)) {
        $userID = eliminateExploit($_POST["userID"]);

        $date = date('Y-m-d H:i:s');
        $commentDB = new CommentDB();
        $commentID = genCommentID();

        $comment = new Comment($commentID, $userID, new Announcement($id), $storedValue["desc"], $date);
        if ($commentDB->insert($comment)) {
            $storedValue["desc"] = "";
        } else {
            echo "Database error! Please try again...";
        }
    }
}

//***************************Delete Comment************************************
if (isset($_POST["commentId"])){
    $commentID = eliminateExploit($_POST["commentId"]);
    if(!empty($commentID)){
        $commentDB = new CommentDB();
        $commentDB->delete($commentID);
    }
}

//***************************Generate Comment ID************************************
function genCommentID() {
    $commentDB = new CommentDB();
    $count = $commentDB->getCount();
    $commentID = "";
    if ($count == 0) {
        $commentID = "CO0001";
    } else {
        $commentList = array();
        $commentList = $commentDB->getAllID();
        $lastID = $commentList[$count - 1];
        $idNum = $lastID[2];
        $idNum .= $lastID[3];
        $idNum .= $lastID[4];
        $idNum .= $lastID[5];
        $idNum = (int) $idNum;
        $idNum += 1;

        if ($idNum < 10000) {
            switch (strlen((string) $idNum)) {
                case 1:
                    $commentID = "CO000" . (string) $idNum;
                    break;
                case 2:
                    $commentID = "CO00" . (string) $idNum;
                    break;
                case 3:
                    $commentID = "CO0" . (string) $idNum;
                    break;
                default:
                    $commentID = "CO" . (string) $idNum;
                    break;
            }
        } else {
            $commentID = "Error";
        }
    }

    return $commentID;
}

function eliminateExploit($str) {
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}

