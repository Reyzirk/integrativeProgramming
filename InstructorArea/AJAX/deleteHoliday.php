<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
if (empty($_POST["holidayID"])){
    echo "fail";
}else{
    $id = trim($_POST["holidayID"]);
    require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/HolidaysParser.php';
    $parser = new HolidaysParser(str_replace("InstructorArea", "", dirname(__DIR__)) . "/XML/holidays.xml");
    if ($parser->removeHoliday($id)){
        echo "success";
        $parser->saveXML(str_replace("InstructorArea", "", dirname(__DIR__)) . "/XML/holidays.xml");
    }else{
        echo "Unable to find the Holiday.";
    }
    
}
