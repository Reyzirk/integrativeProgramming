<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * @author Oon Kheng Huang
 * 
 * Description: Search Announcement API
 */
header("Content-Type:application/json");
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/KhengHuangAPI/searchAnnounceController.php";

if (!empty($_GET['search'])) {
    $search = eliminateExploit($_GET['search']);
    $array = searchAnnouncement($search);

    //Associative array
    $results = array();
    if (!empty($array)) {
        foreach ($array as $row) {
            $results[] = array("announceID" => $row->announceID, "instructorID" => $row->instructorID, "title" => $row->title,
                "desc" => $row->desc, "cat" => $row->cat, "date" => $row->date, "pin" => $row->pin, "allowC" => $row->allowC);
        }
    }

    if (empty($results)) {
        response(200, "No Result Found", NULL);
    } else {
        response(200, "Result Found", $results);
    }
} else {
    response(400, "Invalid Request", NULL);
}

function response($status, $status_message, $results) {
    header("HTTP/1.1 " . $status);

    $response['status'] = $status;
    $response['status_message'] = $status_message;
    $response['results'] = $results;

    $json_response = json_encode($response, JSON_PRETTY_PRINT);
    echo $json_response;
}

function eliminateExploit($str) {
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}
