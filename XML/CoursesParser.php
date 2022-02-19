<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of HolidaysParser
 *
 * @author Choo Meng
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/Course.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/CourseMaterial.php";
class CoursesParser {
    private $courses;
    private $xml;
    public function __construct($filename){
        $this->courses = new SplObjectStorage();
        $this->readFromXML($filename);
    }
    private function readFromXML($filename){
        $xml = simplexml_load_file($filename);
        $courseList = $xml->course;
        $this->xml = $xml;
        foreach($courseList as $course){
            $attr = $course->attributes();
            $tempMaterial = array();
            foreach($course->CourseMaterials as $material){
                $attrMaterial = $material->attributes();
                $tempMaterial[] = new CourseMaterial($attrMaterial->id, $material->name, $material->link);
            }
            $temp = new Course($attr->code,$course->name,$course->desc,$tempMaterial);
            $this->courses->attach($temp);
        }
        
    }
    
    public function getCourses(){
        return $this->courses;
    }
    
    public function getXML(){
        return $this->xml;
    }
    public function removeCourse($id):bool{
        $course = $this->xml->xpath('course[@code="'.$id.'"]');
        if(count($course)>=1){
            $course=$course[0];
            $dom= dom_import_simplexml($course);
            $dom->parentNode->removeChild($dom);
        }else{
            return false;
        }
        $this->updateList();
        return true;
    }
    public function saveXML($filename){
        $this->xml->asXml($filename);
    }
    private function updateList(){
        $this->courses = new SplObjectStorage();
        $courseList = $this->xml->course;
        foreach($courseList as $course){
            $attr = $course->attributes();
            $tempMaterial = array();
            foreach($course->CourseMaterials as $material){
                $attrMaterial = $material->attributes();
                $tempMaterial[] = new CourseMaterial($attrMaterial->id, $material->name, $material->link);
            }
            $temp = new Course($attr->code,$course->name,$course->desc,$tempMaterial);
            $this->courses->attach($temp);
        }
    }
}
