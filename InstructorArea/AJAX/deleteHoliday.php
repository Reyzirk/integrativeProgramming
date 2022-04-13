<?php
//Author: Poh Choo Meng
/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
require_once "AJAXErrorHandler.php";
if (empty($_POST["holidayID"])){
    echo "fail";
}else{
    $id =  eliminateExploit($_POST["holidayID"]);
    require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/ParserFactory.php';
    $factory = new ParserFactory();
    $parser = $factory->getParser("Holidays");
    if ($parser->removeHoliday($id)){
        echo "success";
        $factory->saveXML("Holidays");
    }else{
        echo "Unable to find the Holiday.";
    }
    
}
function eliminateExploit($str){
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}
