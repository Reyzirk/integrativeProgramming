<?php
/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
//Check session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once 'ini_load.php';
include_once 'exception_load.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/DBController.php";
try{
    DBController::getInstance();
} catch (PDOException $ex) {
    callErrorLog($ex);
}




