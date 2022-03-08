<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of viewcourse
 *
 * @author Choo Meng
 */
if (empty($_GET["id"])){
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: courses.php');
}
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/CourseMaterial.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/Course.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/ParserFactory.php';
$factory = new ParserFactory();
$parser = $factory->getParser("Courses");
$id = $_GET["id"];
$retrievedCourse = $parser->getCourse($id);
if (empty($retrievedCourse)){
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: courses.php');
}

function convertByteToOther($size){
    if ($size >= 1048576){
        return number_format((float)$size/1048576.0, 2, '.', '')." MB";
    }else if ($size>=1024){
        return number_format((float)$size/1024.0, 2, '.', '')." KB";
    }else{
        return number_format((float)$size, 2, '.', '').+" bytes";
    }
}
