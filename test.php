<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
require_once 'XML/ParserFactory.php';
$factory = new ParserFactory();
$parser = $factory->getParser("Courses");
while($course = $parser->getCourses()->next()){
    echo $course->courseCode;   
}