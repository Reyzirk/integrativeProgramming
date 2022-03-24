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
$parentID = "P00001"; //++++++++++++++++++++++++++to be changed to session
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/AnnouncementDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/ReadStatus.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/ReadStatusDB.php";

$announceDB = new AnnouncementDB();
if(empty($_POST["inputSearch"])){
    $search = "";
}else{
    $search = eliminateExploit($_POST["inputSearch"]);
}

try {
    $totalCount = $announceDB->getCountBySearch($search); 
} catch (PDOException $ex) {
    if ($generalSection["maintenance"] == true) {
        echo $ex->getMessage();
    } else {
        callPDOExceptionLog($ex);
    }
}

$builder = new MySQLQueryBuilder();
$query = $builder->select(array("announcement"), array("*"))
        ->where("AnnounceID", "%" . $search . "%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("Date", "%" . $search . "%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("Title", "%" . $search . "%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("Cat", "%" . (empty($search) ? "" : strtoupper($search[0])) . "%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->order("Date", "DESC")
        ->query();
try {
    $results = $announceDB->select($query);
} catch (PDOException $ex) {
    if ($generalSection["maintenance"] == true) {
        echo $ex->getMessage();
    } else {
        callPDOExceptionLog($ex);
    }
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
