<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * //Author: Poh Choo Meng
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/CoursesParser.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/HolidaysParser.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/GradesParser.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/Parser.php';
class ParserFactory{
    public function getParser($type){
        if ($type == "Courses"){
            return CoursesParser::getInstance(str_replace("InstructorArea", "", dirname(__DIR__)) . "/XML/courses.xml");
        }else if ($type =="Holidays"){
            return HolidaysParser::getInstance(str_replace("InstructorArea", "", dirname(__DIR__)) . "/XML/holidays.xml");
        }else if ($type =="Grades"){
            return GradesParser::getInstance(str_replace("InstructorArea", "", dirname(__DIR__)) . "/XML/grades.xml");
        }else{
            return NULL;
        }
    }
    public function saveXML($type){
        $parser = $this->getParser($type);
        if ($type == "Courses"){
            $parser->saveXML(str_replace("InstructorArea", "", dirname(__DIR__)) . "/XML/courses.xml");
        }else if ($type =="Holidays"){
            $parser->saveXML(str_replace("InstructorArea", "", dirname(__DIR__)) . "/XML/holidays.xml");
        }else if ($type =="Grades"){
            $parser->saveXML(str_replace("InstructorArea", "", dirname(__DIR__)) . "/XML/grades.xml");
        }
        return true;
    }
} 