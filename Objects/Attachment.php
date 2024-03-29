<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 *   
 * 
 *  Description of Attachment
 *
 * @author Oon Kheng Huang
 * 
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/Announcement.php";

class Attachment{
    private $attachID;
    private $announce;
    private $attachName;
    private $filePath;
    
    public function __construct($attachID, Announcement $announce, $attachName, $filePath) {
        $this->attachID = $attachID;
        $this->announce = $announce;
        $this->filePath = $filePath;
        $this->attachName = $attachName;
        
    }
    
    public function __get($name) {
        if (property_exists($this, $name)){
            return $this->$name;
        }else{
            trigger_error("Property $name doesn't exists", E_USER_ERROR);
        }
    }
    
    public function __set($name, $value) {
        if (property_exists($this, $name)){
            $this->$name = $value;
        }else{
            trigger_error("Property $name doesn't exists", E_USER_ERROR);
        }
    }
    
}

