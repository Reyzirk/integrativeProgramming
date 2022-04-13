<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of AttendanceParser
 *
 * @author Ng Kar Kai
 */

require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/ChildTemperature.php";

class AttendanceParser {
    private $attendanceParse; 
    
    public function __construct($filename) {
        $this->attendanceParse = new SplObjectStorage();
        $this->readFromXML($filename);
        $this->display();
    }
    
    public  function readFromXML ($filename){
        $xml = simplexml_load_file($filename);
        $tempList = $xml->childTemperature;
        
        foreach ($tempList as $row){
            $attr  = $row->attributes();
            $temperatureList = new ChildTemperature($attr->temperature,$row->code, $row->description, $row->safetyLevel);
            $this->attendanceParse->attach($temperatureList);
        }
        
    }
    
    public function display(){
        echo "<h2>Temperature Danger Levels</h2>";
        foreach ($this->attendanceParse as $row){
            print $row."<br/>";
        }
    }
}

$newTemperature = new AttendanceParser("attendance.xml");
