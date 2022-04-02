<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/HolidaysXSLT.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/GradesXSLT.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/CoursesXSLT.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/XSLTInterface.php';
class XSLTFactory{
    public function getXSLT($type){
        if ($type == "Holidays"){
            return HolidaysXSLT::getInstance(str_replace("InstructorArea", "", dirname(__DIR__)) . "/XML/holidays.xml");
        }else if ($type =="Grades"){
            return GradesXSLT::getInstance(str_replace("InstructorArea", "", dirname(__DIR__)) . "/XML/grades.xml");
        }else if ($type =="Courses"){
            return CoursesXSLT::getInstance(str_replace("InstructorArea", "", dirname(__DIR__)) . "/XML/courses.xml");
        }else{
            return NULL;
        }
    }
} 