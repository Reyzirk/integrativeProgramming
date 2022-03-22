<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * @author Oon Kheng Huang
 */

require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/AnnouncementInterface.php";

abstract class AnnounceDecorator implements AnnouncementInterface{
    protected $announce;
    
    public function __construct($announce) {
        $this->announce = $announce;
    }
    
    public function getAnnounce() {
        return $this->announce;
    }

    public function setAnnounce($announce): void {
        $this->announce = $announce;
    }
        
    public abstract function getAnnounceDesc();
}

