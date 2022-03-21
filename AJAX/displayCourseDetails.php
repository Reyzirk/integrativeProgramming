<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
require_once "AJAXErrorHandler.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/ParserFactory.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/Course.php";
$factory = new ParserFactory();
if (empty($_POST["courseCode"])){
    echo "fail";
}else{
    $id = eliminateExploit($_POST["courseCode"]);
    require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/ParserFactory.php';
    $factory = new ParserFactory();
    $parser = $factory->getParser("Courses");
    $course = $parser->getCourse($id);
    if ($course == NULL){
        echo "Unable to find the Course.";
        return;
    }
    
}
function eliminateExploit($str){
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
} 
$material = $course->courseMaterials;
$materialArray = array();
foreach($material as $value){
    $materialArray[] = array("name"=>$value->materialName,"link"=>$value->materialLink);
}
echo json_encode(array("code"=>$course->courseCode,"name"=>$course->courseName,"desc"=>$course->courseDesc,"material"=>$materialArray));
?>

