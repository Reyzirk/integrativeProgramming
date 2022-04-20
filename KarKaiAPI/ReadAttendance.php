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
        $facade = new AttendanceFacade();
        if (!empty($_GET["date"])) {
            $date = antiExploit($_GET["date"]);
            $results = $facade->getAttendanceRecordDate($date);
            $attendanceListData = array();
            $count = 0;
            foreach ($results as $row) {
                $attendanceData = array("AttendanceID" => $row["AttendanceID"], "ChildID" => $row["ChildID"], "Child Temperature" => $row["ChildTemperature"], "AttendingDate" => $row["AttendingDate"]);
                $attendanceListData[] = $attendanceData;
                $count++;
            }

            if (empty($attendanceListData)) {
                $output[] = array("Status" => "Invalid", "AttendanceList" => "No valid attendance list found", "TotalRecords" => $count);
                $response = json_encode($output, JSON_PRETTY_PRINT);
                sendOutput($response, array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
            } else {
                $output[] = array("Status" => "Successful", "AttendanceList" => $attendanceListData, "TotalRecords" => $count);
                $response = json_encode($output, JSON_PRETTY_PRINT);
                sendOutput($response, array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
            }
        } else if (!empty($_GET["childname"])) {
            $childName = antiExploit($_GET["childname"]);
            $results = $facade->getAttendanceRecords($childName);
            $attendanceListData = array();
            $count = 0;
            foreach ($results as $row) {
                $attendanceData = array("AttendanceID" => $row["AttendanceID"], "ChildID" => $row["ChildID"], "Child Temperature" => $row["ChildTemperature"], "AttendingDate" => $row["AttendingDate"]);
                $attendanceListData[] = $attendanceData;
                $count++;
            }
            if (empty($attendanceListData)) {
                $output[] = array("Status" => "Invalid", "AttendanceList" => "No valid attendance list found", "TotalRecords" => $count);
                $response = json_encode($output, JSON_PRETTY_PRINT);
                sendOutput($response, array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
            } else {
                $output[] = array("Status" => "Successful", "AttendanceList" => $attendanceListData, "TotalRecords" => $count);
                $response = json_encode($output, JSON_PRETTY_PRINT);
                sendOutput($response, array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
            }
        } else {
            $results = $facade->selectAllAttendanceRecord();
            $count = $facade->getTotalAttendanceRecord();
            $attendanceListData = array();
            foreach ($results as $row) {
                $attendanceData = array("AttendanceID" => $row["AttendanceID"], "ChildID" => $row["ChildID"], "Child Temperature" => $row["ChildTemperature"], "AttendingDate" => $row["AttendingDate"]);
                $attendanceListData[] = $attendanceData;
            }
            if (empty($attendanceListData)) {
                $output[] = array("Status" => "Invalid", "AttendanceList" => "No valid attendance list found", "TotalRecords" => $count);
                $response = json_encode($output, JSON_PRETTY_PRINT);
                sendOutput($response, array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
            } else {
                $output[] = array("Status" => "Successful", "AttendanceList" => $attendanceListData, "TotalRecords" => $count);
                $response = json_encode($output, JSON_PRETTY_PRINT);
                sendOutput($response, array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
            }
        }
    }
} else {
    $output[] = array("Status" => "Failed", "Message" => "API Key doesn't exist");
    $response = json_encode($output, JSON_PRETTY_PRINT);
    sendOutput($response, array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
}

function antiExploit($str) {
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
