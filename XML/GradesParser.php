<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of GradesParser
 *
 * @author Choo Meng
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/XML/XMLArray.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/XML/Parser.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/Grade.php";

class GradesParser implements Parser{
    private $grades;
    private $xml;
    private static $parser;
    public function __construct($filename){
        $this->grades = new XMLArray();
        $this->readFromXML($filename);
    }
    public static function getInstance($filename){
        if (self::$parser==NULL){
            self::$parser = new GradesParser($filename);
        }
        return self::$parser;
    }
    private function readFromXML($filename){
        $xml = simplexml_load_file($filename);
        $gradeList = $xml->grade;
        $this->xml = $xml;
        foreach($gradeList as $grade){
            $attr = $grade->attributes();
            $temp = new Grade($attr->gradeID,$grade->grade,$grade->minMark, $grade->maxMark);
            $this->grades->add($temp);
        }
        
    }
    
    public function getGrades(){
        return $this->grades;
    }
    
    public function getXML(){
        return $this->xml;
    }
    public function checkExist($grade):bool{
        $grade = $this->xml->xpath('/grades/grade[grade="'.strtoupper($grade).'"]');
        if(count($grade)>=1){
            return true;
        }else{
            return false;
        }
    }
    public function checkMarkBetween($mark):bool{
        $grade = $this->xml->xpath('/grades/grade[minMark <= '.$mark.' and '.$mark.' <= maxMark]');
        if(count($grade)>=1){
            return true;
        }else{
            return false;
        }
    }
    public function checkMarkLeast($mark):bool{
        $grade = $this->xml->xpath('/grades/grade[ '.$mark.'< minMark]');
        if(count($grade)>=1){
            return true;
        }else{
            return false;
        }
    }
    public function checkMarkGreaterMin($mark):bool{
        $grade = $this->xml->xpath('/grades/grade[ minMark > '.$mark.' ]');
        if(count($grade)>=1){
            return true;
        }else{
            return false;
        }
    }
    public function checkMarkLesserMax($mark):bool{
        $grade = $this->xml->xpath('/grades/grade[ maxMark < '.$mark.' ]');
        if(count($grade)>=1){
            return true;
        }else{
            return false;
        }
    }
    public function checkMarkGreatest($mark):bool{
        $grade = $this->xml->xpath('/grades/grade[ '.$mark.' > maxMark]');
        if(count($grade)>=1){
            return true;
        }else{
            return false;
        }
    }
    public function updateGrade($gradeItem):bool{
        $grade = $this->xml->xpath('grade[@gradeID="'.$gradeItem->gradeID.'"]');
        if(count($grade)>=1){
            $grade=$grade[0];
            $dom= dom_import_simplexml($grade);
            $dom->childNodes->item(0)->nodeValue= strtoupper($gradeItem->grade);
            $dom->childNodes->item(1)->nodeValue=$gradeItem->minMark;
            $dom->childNodes->item(2)->nodeValue=$gradeItem->maxMark;
        }else{
            return false;
        }
        return true;
    }
    public function getGrade($id){
        $grade = $this->xml->xpath('grade[@gradeID="'.$id.'"]');
        if(count($grade)>=1){
            $grade=$grade[0];
            $dom= dom_import_simplexml($grade);
            return new Grade($id,$dom->childNodes->item(0)->nodeValue,$dom->childNodes->item(1)->nodeValue,$dom->childNodes->item(2)->nodeValue);
        }else{
            return null;
        }
    }
    public function getGradeByMark($mark){
        $grade = $this->xml->xpath('/grades/grade[minMark<= '.$mark.' and '.$mark.' <= maxMark]');
        if(count($grade)>=1){
            $grade=$grade[0];
            $dom= dom_import_simplexml($grade);
            return new Grade($dom->nodeValue,$dom->childNodes->item(0)->nodeValue,$dom->childNodes->item(1)->nodeValue,$dom->childNodes->item(2)->nodeValue);
        }else{
            return null;
        }
    }
    public function removeGrade($id):bool{
        $grade = $this->xml->xpath('grade[@gradeID="'.$id.'"]');
        if(count($grade)>=1){
            $grade=$grade[0];
            $dom= dom_import_simplexml($grade);
            $dom->parentNode->removeChild($dom);
        }else{
            return false;
        }
        while($key = $this->grades->next()){
            if ($key->gradeID==$id){
                $this->grades->remove();
                return true;
            }
        }
    }
    public function reputGrade($existgrade){
        $grade = $this->xml->addChild('grade');
        $grade->addAttribute('gradeID', $existgrade->gradeID);
        $grade->addChild('grade',$existgrade->grade);
        $grade->addChild('minMark',$existgrade->minMark);
        $grade->addChild('maxMark',$existgrade->maxMark);
        $this->grades->add($existgrade);
    }
    public function addGrade($newGrade){
        $grade = $this->xml->addChild('grade');
        $grade->addAttribute('gradeID', uniqid("G", true));
        $grade->addChild('grade',strtoupper($newGrade->grade));
        $grade->addChild('minMark',$newGrade->minMark);
        $grade->addChild('maxMark',$newGrade->maxMark);
        $this->grades->add($newGrade);
    }
    public function saveXML($filename){
        $this->xml->asXml($filename);
    }
}
