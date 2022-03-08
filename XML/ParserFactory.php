<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/CoursesParser.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/HolidaysParser.php';
class ParserFactory{
    public function getParser($type){
        if ($type == "Courses"){
            return CoursesParser::getInstance(str_replace("InstructorArea", "", dirname(__DIR__)) . "/XML/courses.xml");
        }else if ($type =="Holidays"){
            return HolidaysParser::getInstance(str_replace("InstructorArea", "", dirname(__DIR__)) . "/XML/holidays.xml");
        }else{
            return NULL;
        }
    }
} 