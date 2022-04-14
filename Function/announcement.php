<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * Parent Function/announcement
 * 
 * @author Oon Kheng Huang
 */
$parentID = $_SESSION["parentID"]; //++++++++++++++++++++++++++to be changed to session
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/AnnouncementDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/ReadStatus.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/Announcement.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/ReadStatusDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Function/KhengHuangAPI/searchAnnounceController.php";

$announceDB = new AnnouncementDB();
$searchClick = false;

if (empty($_POST["inputSearch"])) {
    $search = "";
} else {
    //*******************************************>>>Client Side API Call<<<*********************************************
    
    $search = $_POST["inputSearch"];
    $url = "http://localhost/integrativeProgramming/Function/KhengHuangAPI/api.php?search=" . urlencode($search);
    $client = curl_init($url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    $result = json_decode($response, true);
    $results = array();

    if (!empty($result) && $result["status_message"] == "Result Found") {
        $temp = array();
        for($i=0; $i < count(array($result["results"])); $i++) {
            foreach($result["results"][$i] as $name => $value){
                $temp[$name] = $value;
            }
            $results[] = new Announcement($temp["announceID"], $temp["instructorID"], $temp["title"], $temp["desc"], 
                    $temp["cat"], $temp["date"], $temp["pin"], $temp["allowC"]);
        }
    }

    $searchClick = true;
}

//Initialize Announcement/ Display Announcement List
if (!$searchClick) {
    $results = $announceDB->list();
}

$pinAnnounce = $announceDB->pinTop();

function eliminateExploit($str) {
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}

//***********Convert Category Char to String***************
function convertCatToWord($cat) {
    switch ($cat) {
        case 'A':
            return "Activity";
            break;
        case 'C':
            return "Covid19";
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
function callLog() {
    if (!empty($_SESSION["successUpdate"])) {

        
        ?>
        <script>
            setTimeout(function (){
                Toast.fire({
                    icon: 'success',
                    html: '<b>Sucessful</b><br/>Update the user profile.'
                })
            },1500);
        </script>
        <?php
        unset($_SESSION["successUpdate"]);
    }
}