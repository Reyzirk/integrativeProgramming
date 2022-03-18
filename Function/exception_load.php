<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

function callErrorLog($exception){
    $message = $exception->getMessage();
    error_log("[".date("Y-m-d H:i:s")."] $message \n", 3, "error.log");
}
set_exception_handler('callErrorLog');