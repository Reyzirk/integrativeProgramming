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
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/CoursesParser.php';
$parser = new CoursesParser(str_replace("InstructorArea", "", dirname(__DIR__)) . "/XML/courses.xml");
$id = $_GET["id"];
$retrievedCourse = $parser->getCourse($id);
if (empty($retrievedCourse)){
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: courses.php');
}

function convertByteToOther($size){
    if ($size >= 1048576){
        return $size/1048576.0+" MB";
    }else if ($size>=1024){
        return $size/1024.0+" KB";
    }else{
        return $size+" bytes";
    }
}
