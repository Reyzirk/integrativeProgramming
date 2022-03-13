<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

if (empty($_POST["gradeID"])){
    echo "fail";
}else{
    $id =  eliminateExploit($_POST["gradeID"]);
    require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/ParserFactory.php';
    $factory = new ParserFactory();
    $parser = $factory->getParser("Grades");
    if ($parser->removeGrade($id)){
        echo "success";
        $factory->saveXML("Grades");
    }else{
        echo "Unable to find the Grade.";
    }
    
}
function eliminateExploit($str){
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}