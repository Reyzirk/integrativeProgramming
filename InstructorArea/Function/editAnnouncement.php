<?php
/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * Description of edit announcement
 * 
 * @author Oon Kheng Huang
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/Announcement.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/AnnouncementDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/Attachment.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/AttachmentDB.php";

if (empty($_GET["aID"])) {
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: announcement.php');
} else {
    $id = $_GET["aID"];
    $announceDB = new AnnouncementDB();
    $attachDB = new AttachmentDB();
    $getAnnounce = $announceDB->details($id);

    if (!empty($getAnnounce)) {
        $storedValue["announceID"] = $getAnnounce->announceID;
        $storedValue["title"] = $getAnnounce->title;
        $storedValue["desc"] = $getAnnounce->desc;
        $storedValue["cat"] = trim($getAnnounce->cat);
        $storedValue["instructorID"] = $getAnnounce->instructorID;
        $storedValue["pinTop"] = $getAnnounce->pin;
        $storedValue["allowC"] = $getAnnounce->allowC;

        if (!empty($attachDB->details($id))) {
            $getAttach = $attachDB->details($id);
            $file = array();
            foreach ($getAttach as $row) {
                $file[] = $row->attachName;
            }
            $storedValue["attach"] = $file;
        } else {
            $storedValue["attach"] = null;
        }
    } else {
        $_SESSION["errorLog"] = "noid";
        header('HTTP/1.1 307 Temporary Redirect');
        header('Location: announcement.php');
    }
}

//*************Remove Attachment*************
if (isset($_POST["confirmFile"])) {
    $id = $_GET["aID"];
    $attachDB = new AttachmentDB();
    $attachDB->delete($id);
    $storedValue["attach"] = null;
}

if (isset($_POST["formDetect"])) {
    $date = trim($_POST["hiddenDate"]);

    //***************************Title Validation************************************
    $inputName = "titleA";
    $inputTitle = "Title";
    if (empty($_POST[$inputName])) {
        $error[$inputName] = "<b>$inputTitle</b> cannot be empty.";
    } else {
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
        if (strlen($storedValue[$inputName]) > 50) {
            $error[$inputName] = "<b>$inputTitle</b> cannot contain more than 50 characters";
        }
    }

    //***************************Description Validation************************************ 
    $inputName = "desc";
    $inputTitle = "Description";
    if (empty($_POST[$inputName])) {
        $error[$inputName] = "<b>$inputTitle</b> cannot empty.";
    } else {
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
    }

    //***************************Category Validation************************************
    $inputName = "cat";
    $inputTitle = "Category";
    if (empty($_POST[$inputName])) {
        $error[$inputName] = "<b>$inputTitle</b> is not selected";
    } else {
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
    }

    //***************************Store allow comment value************************************
    $inputName = "allowC";
    if (isset($_POST["allowC"])) {
        $storedValue[$inputName] = 1;
    } else {
        $storedValue[$inputName] = 0;
    }

    //***************************Store pin to top value************************************
    $inputName = "pinTop";
    if (isset($_POST["pinTop"])) {
        $storedValue[$inputName] = 1;
    } else {
        $storedValue[$inputName] = 0;
    }

    //***************************Attachment Validation************************************
    $inputName = "attach";
    $inputTitle = "Attachment";
    $hasFile = false;

    //**************Check if has file****************
    foreach (($_FILES[$inputName]['error']) as $row) {
        switch ($row) {

            case UPLOAD_ERR_NO_FILE:
                $hasFile = false;
                break;
            case UPLOAD_ERR_OK:
                $hasFile = true;
                break;
            default :
                $hasFile = true;
        }
    }

    if (isset($_FILES[$inputName]) && $hasFile) {
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
                        $error[$inputName] = "<b>$inputTitle</b> There was an error while uploading the file. Error Code: " . $errorCode;
                        break;
                }
            } else if ($files["size"][$i] > $generalSection["file_max_size"]) {
                $error[$inputName] = "<b>$inputTitle</b> File uploaded is too large. Maximum " . convertByteToOther($generalSection["file_max_size"]) . ".";
            } else {
                $ext[] = strtolower(pathinfo($files["name"][$i], PATHINFO_EXTENSION));
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

    //***************************Connect Database************************************
    if (empty($error)) {

        $announce = new Announcement($id, "I0001", $storedValue["titleA"], $storedValue["desc"], $storedValue["cat"], $date, $storedValue["pinTop"], $storedValue["allowC"]);
        $AnnounceDB = new AnnouncementDB();

        $AnnounceDB->update($id, $announce);
        $_SESSION["modifyLog"] = "createannouncement";

        //*************if have attachments*******************
        if ($hasFile) {
            $attachDB = new AttachmentDB();
            $files = $_FILES["attach"];
            for ($i = 0; $i < count($files["name"]); $i++) {

                $save_as = uniqid("", true) . '.' . $ext[$i];
                move_uploaded_file($files['tmp_name'][$i], str_replace("InstructorArea", "", dirname(__DIR__)) . '/uploads/AnnounceAttachment/' . $save_as);
                $attachment = new Attachment(genAttachID(), $announce, $save_as, '/uploads/AnnounceAttachment/' . $save_as);
                if ($attachDB->insert($attachment)) {
                    $_SESSION["modifyLog"] = "createattachment";
                    header('HTTP/1.1 307 Temporary Redirect');
                    header('Location: announcement.php');
                } else {
                    $_SESSION["errorLog"] = "sqlerror";
                    break;
                }
            }
        } else {
            header('HTTP/1.1 307 Temporary Redirect');
            header('Location: announcement.php');
        }
    }

    if (!empty($_SESSION["errorLog"])) {

        if ($_SESSION["errorLog"] == "sqlerror1") {
            $successMsg = "Database error. Please try again1!";
        }
        ?>
        <script>
            setTimeout(function () {
                Toast.fire({
                    icon: 'success',
                    html: '<b>Sucessful</b><br/><?php echo $successMsg; ?>.'
                })
            }, 1500);
        </script>
        <?php
        unset($_SESSION["errorLog"]);
    }
}

//***************************Generate Attachment ID************************************
function genAttachID() {
    $attachDB = new AttachmentDB();
    $count = $attachDB->getCount();
    $attachID = "";
    if ($count == 0) {
        $attachID = "AT0001";
    } else {
        $attachList = array();
        $attachList = $attachDB->getAllID();
        $lastID = $attachList[$count - 1];
        $idNum = $lastID[2];
        $idNum .= $lastID[3];
        $idNum .= $lastID[4];
        $idNum .= $lastID[5];
        $idNum = (int) $idNum;
        $idNum += 1;

        if ($idNum < 10000) {
            switch (strlen((string) $idNum)) {
                case 1:
                    $attachID = "AT000" . (string) $idNum;
                    break;
                case 2:
                    $attachID = "AT00" . (string) $idNum;
                    break;
                case 3:
                    $attachID = "AT0" . (string) $idNum;
                    break;
                default:
                    $attachID = "AT" . (string) $idNum;
                    break;
            }
        } else {
            $attachID = "Error";
        }
    }

    return $attachID;
}

//***************************Trim the variable************************************
function eliminateExploit($str) {
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}
