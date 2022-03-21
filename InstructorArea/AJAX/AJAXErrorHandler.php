<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Function/ini_load.php';
function callExceptionLog($exception){
    $message = $exception->getMessage();
    error_log("[".date("Y-m-d H:i:s")."] $message \n", 3, "exception.log");
    header("HTTP/1.1 500 Internal Server Error");
}
function callPDOExceptionLog($exception){
    $message = $exception->getMessage();
    error_log("[".date("Y-m-d H:i:s")."] $message \n", 3, "exception.log");
    header("HTTP/1.1 500 Internal Server Error");
}
function callErrorLog($errNo, $errstr, $errfile, $errline){
    error_log("[".date("Y-m-d H:i:s")."] [$errNo]$errstr | Fatal error on line $errline in file $errfile \n", 3, "error.log");
    header("HTTP/1.1 500 Internal Server Error");
}
//set_exception_handler('callExceptionLog');
//set_error_handler('callErrorLog');
