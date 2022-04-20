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
require_once str_replace("InstructorArea", "", str_replace("Demo", "", str_replace("Function", "", dirname(__DIR__))))."/Database/ParentDB.php";
require_once str_replace("InstructorArea", "", str_replace("Demo", "", str_replace("Function", "", dirname(__DIR__))))."/Database/InstructorDB.php";


include_once 'exception_load.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/DBController.php";
try{
    DBController::getInstance();
} catch (PDOException $ex) {
    callErrorLog($ex);
}
//For PHP version that below 8.0
function custom_str_contains2(string $haystack, string $needle): bool {
    return '' === $needle || false !== strpos($haystack, $needle);
}


