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
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/Holiday.php";

class HolidaysParser implements Parser{
    private $holidays;
    private $xml;
    private static $parser;
    public function __construct($filename){
        $this->holidays = new SplObjectStorage();
        $this->readFromXML($filename);
    }
    public static function getInstance($filename){
        if (self::$parser==NULL){
            self::$parser = new HolidaysParser($filename);
        }
        return self::$parser;
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
        $holiday = $this->xml->xpath('holiday[@id="'.$holidayItem->id.'"]');
        if(count($holiday)>=1){
            $holiday=$holiday[0];
            $dom= dom_import_simplexml($holiday);
            $dom->childNodes->item(0)->nodeValue=$holidayItem->name;
            $dom->childNodes->item(1)->nodeValue=$holidayItem->dateStart;
            $dom->childNodes->item(2)->nodeValue=$holidayItem->dateEnd;
        }else{
            return false;
        }
        return true;
    }
    public function getHoliday($id){
        $holiday = $this->xml->xpath('holiday[@id="'.$id.'"]');
        if(count($holiday)>=1){
            $holiday=$holiday[0];
            $dom= dom_import_simplexml($holiday);
            return new Holiday($id,$dom->childNodes->item(0)->nodeValue,$dom->childNodes->item(1)->nodeValue,$dom->childNodes->item(2)->nodeValue);
        }else{
            return null;
        }
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
        foreach ($this->holidays as $key) {
            if ($key->id==$id){
                $this->holidays->detach($key);
                return true;
            }
        }
    }
    public function addHoliday($newHoliday){
        $holiday = $this->xml->addChild('holiday');
        $holiday->addAttribute('id', uniqid("H", true));
        $holiday->addChild('name',$newHoliday->name);
        $holiday->addChild('dateStart',$newHoliday->dateStart);
        $holiday->addChild('dateEnd',$newHoliday->dateEnd);
    }
    public function saveXML($filename){
        $this->xml->asXml($filename);
    }
}
