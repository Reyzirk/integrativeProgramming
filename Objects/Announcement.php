<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * Description of Announcement
 *
 * @author Oon Kheng Huang
 * 
 */

class Announcement {

    private $announceID;
    private $instructorID;
    private $title;
    private $desc;
    private $cat;
    private $date;
    private $pin;
    private $allowC;

    public function __construct($announceID, $instructorID, $title, $desc, $cat, $date, $pin, $allowC) {
        $this->announceID = $announceID;
        $this->instructorID = $instructorID;
        $this->title = $title;
        $this->desc = $desc;
        $this->cat = $cat;
        $this->date = $date;
        $this->pin = $pin;
        $this->allowC = $allowC;
        
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
