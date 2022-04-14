<?php
/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
//Author: Poh Choo Meng, Oon Kheng Huang, Ng Kar Kai, Fong Shu Ling
//Check session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once 'ini_load.php';
require_once dirname(__DIR__)."/Database/ParentDB.php";
if(!isset($_SESSION["parentID"])){
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: login.php');
}else{
    $parentdb = new ParentDB();
    $details = $parentdb->details($_SESSION["parentID"]);
    if ($details==null){
        header('HTTP/1.1 307 Temporary Redirect');
        header('Location: login.php');
    }
}
include_once 'exception_load.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/DBController.php";
try{
    DBController::getInstance();
} catch (PDOException $ex) {
    callErrorLog($ex);
}




