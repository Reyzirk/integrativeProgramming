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
$type = array("holiday","course","grade");
$defaultApi = 0;
for ($i = 0;$i < count($uri);$i++){
    if (strtolower($uri[$i])=="cmapi.php"){
        $defaultApi = $i;
    }
}
if (empty($uri[$defaultApi+1])){
    header("HTTP/1.1 404 Not Found");
    return;
}else if (!in_array($uri[$defaultApi+1],$type)){
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
    }else if ($type=="create"){
        $holidayController->create();
    }
}else if ($dataType == "course"){
    $courseController = $factory->getController("Course");
    $type = $uri[$defaultApi+2];
    if ($type=="list"){
        $courseController->list();
    }else if ($type=="details"){
        $courseController->details();
    }else{
        header("HTTP/1.1 404 Not Found");
        return;
    }
}else if ($dataType == "grade"){
    $gradeController = $factory->getController("Grade");
    $type = $uri[$defaultApi+2];
    if ($type=="list"){
        $gradeController->list();
    }else if ($type=="details"){
        $gradeController->details();
    }else{
        header("HTTP/1.1 404 Not Found");
        return;
    }
}else if ($dataType == "examination"){
    $examController = $factory->getController("Examination");
    $type = $uri[$defaultApi+2];
    if ($type=="list"){
        $examController->list();
    }else if ($type=="get"){
        $examController->get();
    }else{
        header("HTTP/1.1 404 Not Found");
        return;
    }
}
