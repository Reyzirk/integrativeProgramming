<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * //Author: Tang Khai Li
 */
require_once "../Database/ParentDB.php";
header("Content-Type:application/json");

//Secure conding practice 
$ini_arr = parse_ini_file(str_replace("Function", "", str_replace("InstructorArea", "", dirname(__DIR__))) . "/config.ini", true);
$staticAPI = $ini_arr["General"]["apiKey"];

if (!empty($_GET["key"])) {
    $apiKey = eliminateExploit($_GET["key"]);
    $parentOutput = array();

    if ($apiKey != $staticAPI) {
        $parentOutput[] = array("Status" => "Failed", "Message" => "Invalid API Key entered.");
        $response = json_encode($parentOutput, JSON_PRETTY_PRINT);
        //print_r($output);
        sendOutput($response, array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
    } else {
        $query = "SELECT * FROM parent";
        $parentDB = new ParentDB();
        $results = $parentDB->select($query);
        $parentListData = array();

        foreach ($results as $row) {
            $parentData = array(
                "ParentName" => $row["ParentName"],
                "ParentGender" => $row["ParentGender"],
                "ParentBirth" => $row["ParentBirth"],
                "ParentEmail" => $row["ParentEmail"],
                "ParentPhone" => $row["ParentPhoneNo"],
                "ParentIcNo" => $row["ParentIcNo"],
                "ParentType" => $row["ParentType"]);
            $parentListData[] = $parentData;
        }
        if (empty($parentListData)) {
            $parentOutput[] = array("Status" => "Successful", "Parent List" => "Invalid List");
            $response = json_encode($parentOutput, JSON_PRETTY_PRINT);
            sendOutput($response, array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
        } else {
            $parentOutput[] = array("Status" => "Successful", "Parent List" => $parentListData);
            $response = json_encode($parentOutput, JSON_PRETTY_PRINT);
            sendOutput($response, array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
        }
    }
} else {
    $output[] = array("Status" => "Failed", "Message" => "API Key doesn't exist");
    $response = json_encode($output, JSON_PRETTY_PRINT);
    sendOutput($response, array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
}

function eliminateExploit($str) {
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}

function sendOutput($data, $httpHeaders) {
    header_remove('Set-Cookie');

    if (is_array($httpHeaders) && count($httpHeaders)) {
        foreach ($httpHeaders as $header) {
            header($header);
        }
    }

    echo $data;
    return;
}
