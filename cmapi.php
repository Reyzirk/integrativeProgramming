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
require "Function/CMApi/ControllerFactory.php";
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );
$defaultApi = 0;
for ($i = 0;$i < count($uri);$i++){
    if (strtolower($uri[$i])=="api.php"){
        $defaultApi = $uri[$i];
    }
}
if (empty($uri[$defaultApi+1])){
    header("HTTP/1.1 404 Not Found");
    return;
}else if ($uri[$defaultApi+1]!='holiday'){
    header("HTTP/1.1 404 Not Found");
    return;
}else if (!isset ($uri[$defaultApi+2])){
    header("HTTP/1.1 404 Not Found");
    return;
}
$dataType = $uri[$defaultApi+1];
$factory = new ControllerFactory();
if ($dataType == 'holiday'){
    $holidayController = $factory->getController("Holiday");
    $type = $uri[$defaultApi+2];
    if ($type=="list"){
        $holidayController->list();
    }
}else if ($dataType == "course"){
    $courseController = $factory->getController("Course");
    $type = $uri[$defaultApi+2];
    if ($type=="list"){
        $courseController->list();
    }
}
