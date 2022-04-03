<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
//Author: Ng Kar Kai
require_once "../InstructorArea/Function/AttendanceFacade.php";
header("Content-Type:application/json");

$ini_arr = parse_ini_file(str_replace("Function", "", str_replace("InstructorArea", "", dirname(__DIR__))) . "/config.ini", true);

$staticAPI = $ini_arr["General"]["apiKey"];
if (!empty($_GET["key"])) {
    $apiKey = antiExploit($_GET["key"]);
    $output = array();

    if ($apiKey != $staticAPI) {
        $output[] = array("Status" => "Failed", "Message" => "Invalid API Key entered.");
        $response = json_encode($output, JSON_PRETTY_PRINT);
        //print_r($output);
        sendOutput($response, array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
    } else {
        
    }
}
else{
    $output[] = array("Status" =>"Failed", "Message"=>"API Key doesn't exist");
    $response= json_encode($output,JSON_PRETTY_PRINT);
    sendOutput($response, array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
}

function antiExploit($str) {
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}

function printResponses(){
    
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

