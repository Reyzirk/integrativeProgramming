<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * @author Oon Kheng Huang
 */
require_once str_replace("InstructorArea", "", str_replace("Demo", "", dirname(__DIR__))) . "/Database/AnnouncementDB.php";
require_once str_replace("InstructorArea", "", str_replace("Demo", "", dirname(__DIR__))) . "/Function/KhengHuangAPI/searchAnnounceController.php";
require_once str_replace("InstructorArea", "", str_replace("Demo", "", dirname(__DIR__))) . "/Objects/Announcement.php";

$announceDB = new AnnouncementDB();
$searchClick = false;

if (empty($_POST["inputSearch"])) {
    $search = "";
    $storedValue["search"] = "";
} else {
    //*******************************************>>>Client Side API Call<<<*********************************************

    $search = $_POST["inputSearch"];
    $storedValue["search"] = $_POST["inputSearch"];
    $url = "http://localhost/integrativeProgramming/Function/KhengHuangAPI/api.php?search=" . urlencode($search);
    $client = curl_init($url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    $result = json_decode($response, true);
    $results = array();

    if (!empty($result) && $result["status_message"] == "Result Found") {
        $temp = array();
        $i = 0;
        foreach ($result["results"] as $row) {
            foreach ($result["results"][$i] as $name => $value) {
                $temp[$name] = $value;
            }
            $results[] = new Announcement($temp["announceID"], $temp["instructorID"], $temp["title"], $temp["desc"],
                    $temp["cat"], $temp["date"], $temp["pin"], $temp["allowC"]);
            $i++;
        }
    }

    $searchClick = true;
}

//Initialize Announcement/ Display Announcement List
if (!$searchClick) {
    $results = $announceDB->list();
}

