<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
date_default_timezone_set("Asia/Kuala_Lumpur");

$sqlNoError = true;
function callErrorLog($exception){
    global $sqlNoError;
    $message = $exception->getMessage();
    error_log("[".date("Y-m-d H:i:s")."] $message \n", 3, "exception.log");
    $_SESSION["exceptionerror"] = $exception;
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: errorexception.php');
}
function callErrorLogforError($errNo, $errstr, $errfile, $errline){
    error_log("[".date("Y-m-d H:i:s")."] [$errNo]$errstr | Fatal error on line $errline in file $errfile \n", 3, "error.log");
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: index.php');
}
set_exception_handler('callErrorLog');
set_error_handler('callErrorLogforError');