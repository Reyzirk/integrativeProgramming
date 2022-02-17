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
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/Holiday.php";

class HolidaysParser {
    private $holidays;
    private $xml;
    public function __construct($filename){
        $this->holidays = new SplObjectStorage();
        $this->readFromXML($filename);
    }
    private function readFromXML($filename){
        $xml = simplexml_load_file($filename);
        $holidayList = $xml->holiday;
        $this->xml = $xml;
        foreach($holidayList as $holiday){
            $attr = $holiday->attributes();
            $temp = new Holiday($attr->id,$holiday->name,$holiday->dateStart,$holiday->dateEnd);
            $this->holidays->attach($temp);
        }
        
    }
    
    public function getHolidays(){
        return $this->holidays;
    }
    
    public function getXML(){
        return $this->xml;
    }
    public function updateHoliday($holidayItem):bool{
        $holiday = $this->xml->xpath('holiday[@id="'.$holidayItem->getId().'"]');
        if(count($holiday)>=1){
            $holiday=$holiday[0];
            $dom= dom_import_simplexml($holiday);
            $dom->childNodes->item(0)->nodeValue=$holidayItem->getName();
            $dom->childNodes->item(1)->nodeValue=$holidayItem->getDateStart();
            $dom->childNodes->item(2)->nodeValue=$holidayItem->getDateEnd();
        }else{
            return false;
        }
        return true;
    }
    public function removeHoliday($id):bool{
        $holiday = $this->xml->xpath('holiday[@id="'.$id.'"]');
        if(count($holiday)>=1){
            $holiday=$holiday[0];
            $dom= dom_import_simplexml($holiday);
            $dom->parentNode->removeChild($dom);
        }else{
            return false;
        }
        $this->updateList();
        return true;
    }
    public function addHoliday($newHoliday){
        $holiday = $this->xml->addChild('holiday');
        $holiday->addAttribute('id', uniqid("H", true));
        $holiday->addChild('name',$newHoliday->getName());
        $holiday->addChild('dateStart',$newHoliday->getDateStart());
        $holiday->addChild('dateEnd',$newHoliday->getDateEnd());
    }
    public function saveXML($filename){
        $this->xml->asXml($filename);
    }
    private function updateList(){
        $this->holidays = new SplObjectStorage();
        $holidayList = $this->xml->holiday;
        foreach($holidayList as $holiday){
            $attr = $holiday->attributes();
            $temp = new Holiday($attr->id,$holiday->name,$holiday->dateStart,$holiday->dateEnd);
            $this->holidays->attach($temp);
        }
    }
}
