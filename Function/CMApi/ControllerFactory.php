<?php
//Author: Poh Choo Meng
/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/CMApi/GradeController.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/CMApi/HolidayController.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/CMApi/CourseController.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/CMApi/ExaminationController.php';
class ControllerFactory{
    public function getController($type){
        if ($type == "Course"){
            return CourseController::getInstance();
        }else if ($type =="Holiday"){
            return HolidayController::getInstance();
        }else if ($type =="Grade"){
            return GradeController::getInstance();
        }else if ($type =="Examination"){
            return ExaminationController::getInstance();
        }else{
            return NULL;
        }
    }
} 