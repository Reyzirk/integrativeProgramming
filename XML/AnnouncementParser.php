<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * @author Oon Kheng Huang
 */

require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/AnnounceCategory.php";

class AnnouncementParser{
    private $announceCat;
    
    public function __construct($filename) {
        $this->announceCat = new SplObjectStorage();
        $this->readFromXML($filename);
        $this->display();
    }
    
    public function readFromXML($filename) {
        $xml = simplexml_load_file($filename);
        $announceList = $xml->category;
        
        foreach ($announceList as $row){
            $attr = $row->attributes();
            $announceTmp = new AnnounceCategory($attr->catID, $row->name, $row->shortForm, $row->description);
            $this->announceCat->attach($announceTmp);
        }
    }
    
    public function display() {
        echo "<h2>Announcement Category</h2>";
        foreach ($this->announceCat as $row){
            print $row."<br/>";
        }
    }
}

$newAnnounce = new AnnouncementParser("announcement.xml");

