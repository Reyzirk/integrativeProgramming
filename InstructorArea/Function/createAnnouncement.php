<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * @author Oon Kheng Huang
 * 
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/Announcement.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/AnnouncementDB.php";

if (!empty($_POST['submit'])) {
    $date = trim($_POST["hiddenDate"]);

    //Title Validation
    $inputName = "title";
    $inputTitle = "Title";
    if (empty($_POST[$inputName])) {
        $error[$inputName] = "<b>$inputTitle</b> cannot be empty.";
    } else {
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
        if (strlen($storedValue[$inputName]) > 50) {
            $error[$inputName] = "<b>$inputTitle</b> cannot contain more than 50 characters";
        }
    }

    //Description Validation
    $desc = trim($_POST["desc"]);
    $inputName = "desc";
    $inputTitle = "Description";
    if (empty($_POST[$inputName])) {
        $error[$inputName] = "<b>$inputTitle</b> cannot empty.";
    } else {
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
    }


    $inputName = "cat";
    $inputTitle = "Category";
    if (empty($_POST[$inputName])) {
        $error[$inputName] = "<b>$inputTitle</b> is not selected";
    } else {
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
    }

    $inputName = "allowC";
    if (isset($_POST["allowC"])) {
        if ($_POST["allowC"] == "checked") {
            $storedValue[$inputName] = 1;
        } else {
            $storedValue[$inputName] = 0;
        }
    }

    $inputName = "pinTop";
    if (isset($_POST["pinTop"])) {
        if ($_POST["pinTop"] == "checked") {
            $storedValue[$inputName] = 1;
        } else {
            $storedValue[$inputName] = 0;
        }
    }

    $inputName = "attach";
    $inputTitle = "Attachment";
    if (isset($_FILES[$inputName])) {
        $files = $_FILES[$inputName];
        for ($i = 0; $i < count($files["name"]); $i++) {
            $tempFile = $files["tmp_name"][$i];
            $errorCode = $files["error"][$i];
            if ($errorCode > 0) {
                switch ($errorCode) {  
                    case UPLOAD_ERR_FORM_SIZE:
                        $error[$inputName] = "<b>$inputTitle</b> uploaded is too large!";
                        break;
                    default:
                        $error[$inputName] = "<b>$inputTitle</b> There was an error while uploading the file.";
                        break;
                }
            } else if ($files["size"][$i] > $generalSection["file_max_size"]) {
                $error[$inputName] = "<b>$inputTitle</b> File uploaded is too large. Maximum " . convertByteToOther($generalSection["file_max_size"]) . ".";
            } else {
                $ext = strtolower(pathinfo($files["name"][$i], PATHINFO_EXTENSION));
                if ($ext == "php" || $ext == "java" || $ext == "jsp" || $ext == "html" || $ext == "xhtml" || $ext == "js" || $ext == "css" ||
                        $ext == "aspx" || $ext == "cs" || $ext == "py" || $ext == "htaccess" || $ext == "sql" || $ext == "db") {
                    $error[$inputName] = "File type of <b>Attachment</b> not supported.";
                }
            }
            if (isset($error[$inputName])) {
                break;
            }
        }
    }

    $announce = new Announcement($annouceID, $instructorID, $title, $desc, $cat, $date, $pin, $allowC);

    // Connect Database
}

function genAnnounceID() {
    $announceBD = new AnnouncementDB();
    $count = $announceBD->getCount();
    $announceID = "";
    if ($count == 0) {
        $announceID = "AN0001";
    } else {
        $annouceList = array();
        $annouceList = $announceBD->getAllID();
        $lastID = $annouceList[$count - 1];
        $idNum = $lastID[2];
        $idNum .= $lastID[3];
        $idNum .= $lastID[4];
        $idNum .= $lastID[5];
        $idNum = (int) $idNum;
        $idNum += 1;

        if ($idNum < 10000) {
            switch (strlen((string) $idNum)) {
                case 1:
                    $announceID = "AN000" . (string) $idNum;
                    break;
                case 2:
                    $announceID = "AN00" . (string) $idNum;
                    break;
                case 3:
                    $announceID = "AN0" . (string) $idNum;
                    break;
                default:
                    $announceID = "AN" . (string) $idNum;
                    break;
            }
        } else {
            $announceID = "Error";
        }
    }

    return $announceID;
}

function eliminateExploit($str) {
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}
