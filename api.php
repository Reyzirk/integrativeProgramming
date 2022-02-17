<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of api
 *
 * @author Choo Meng
 */
require "Function/CMApi/HolidayController.php";
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );
if (empty($uri[3])){
    header("HTTP/1.1 404 Not Found");
    return;
}else if ($uri[3]!='holiday'){
    header("HTTP/1.1 404 Not Found");
    return;
}else if (!isset ($uri[4])){
    header("HTTP/1.1 404 Not Found");
    return;
}
$holidayController = new HolidayController();
$type = $uri[4];
if ($type=="list"){
    $holidayController->list();
}