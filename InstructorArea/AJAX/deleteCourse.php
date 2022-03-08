<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
if (empty($_POST["courseCode"])){
    echo "fail";
}else{
    $id = eliminateExploit($_POST["courseCode"]);
    require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/ParserFactory.php';
    $factory = new ParserFactory();
    $parser = $factory->getParser("Courses");
    if ($parser->removeCourse($id)){
        echo "success";
        $parser->saveXML(str_replace("InstructorArea", "", dirname(__DIR__)) . "/XML/courses.xml");
    }else{
        echo "Unable to find the Course.";
    }
    
}
function eliminateExploit($str){
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}
