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
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/XML/Parser.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/Course.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/CourseMaterial.php";
class CoursesParser implements Parser{
    private $courses;
    private $xml;
    private static $parser = NULL;
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
    
    public static function getInstance($filename){
        if (self::$parser==NULL){
            self::$parser = new CoursesParser($filename);
        }
        return self::$parser;
    }
    
    public function getCourses(){
        return $this->courses;
    }
    
    public function getXML(){
        return $this->xml;
    }
    public function getCourse($code){
        $course = $this->xml->xpath('course[@code="'.$code.'"]');
        if(count($course)>=1){
            $course=$course[0];
            $dom= dom_import_simplexml($course);
            $material = $course->xpath('CourseMaterials');
            if(count($material)>=1){
                $material=$material[0];
                $dom2= dom_import_simplexml($material);
                for($i = 0;$i < (count($dom2->childNodes));$i++){
                    $node = $dom2->childNodes[$i];
                    $courseMaterials[] = new CourseMaterial((string)$node->attributes->item(0)->nodeValue, (string)$node->childNodes->item(0)->nodeValue, (string)$node->childNodes->item(1)->nodeValue);
                }
            }
            $newCourse = new Course((string)$code,(string)$dom->childNodes->item(0)->nodeValue,(string)$dom->childNodes->item(1)->nodeValue,$courseMaterials);
            return $newCourse;
        }else{
            return null;
        }
    }
    
    public function addCourse($newCourse){
        $course = $this->xml->addChild('course');
        $course->addAttribute('code', $newCourse->courseCode);
        $course->addChild('name',$newCourse->courseName);
        $course->addChild('desc',$newCourse->courseDesc);
        if (count($newCourse->courseMaterials)!=0){
            $material = $course->addChild('CourseMaterials')->addChild("CourseMaterial");
            for ($i = 0;$i < count($newCourse->courseMaterials);$i++){
                $item = $newCourse->courseMaterials[$i];
                $material->addAttribute('id',$item->materialID);
                $material->addChild('name',$item->materialName);
                $material->addChild('link',$item->materialLink);
            }
            
        }
    }
    public function updateCourse($oldID, $updatedCourse):bool{
        $course = $this->xml->xpath('course[@code="'.$oldID.'"]');
        if(count($course)>=1){
            $course=$course[0];
            $dom= dom_import_simplexml($course);
            $dom->parentNode->removeChild($dom);
        }else{
            return false;
        }
        foreach ($this->courses as $key) {
            if ($key->courseCode==$oldID){
                $this->courses->detach($key);
                break;
            }
        }
        $this->addCourse($updatedCourse);
        return true;
    }
    public function removeCourse($id):bool{
        $course = $this->xml->xpath('course[@code="'.$id.'"]');
        if(count($course)>=1){
            $course=$course[0];
            $this->removeCourseMaterial($course);
            $dom= dom_import_simplexml($course);
            $dom->parentNode->removeChild($dom);
        }else{
            return false;
        }
        foreach ($this->courses as $key) {
            if ($key->courseCode==$id){
                $this->courses->detach($key);
                return true;
            }
        }
    }
    public function checkExist($code):bool{
        $course = $this->xml->xpath('course[@code="'.$code.'"]');
        if(count($course)>=1){
            return true;
        }else{
            return false;
        }
    }
    public function removeCourseMaterial($path){
        $material = $path->xpath('CourseMaterials');
        if(count($material)>=1){
            $material=$material[0];
            $dom= dom_import_simplexml($material);
            for($i = 0;$i < (count($dom->childNodes));$i++){
                $node = $dom->childNodes[$i];
                unlink(str_replace("InstructorArea", "", dirname(__DIR__)).'/uploads/CourseMaterial/'.$node->childNodes->item(1)->nodeValue);
            }
        }
        
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
