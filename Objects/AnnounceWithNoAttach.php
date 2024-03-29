<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * @author Oon Kheng Huang
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/Announcement.php";

class AnnounceWithNoAttach extends Announcement {

    public function __construct($announce) {
        parent::__construct($announce->announceID, $announce->instructorID, $announce->title, $announce->desc, $announce->cat, $announce->date, $announce->pin, $announce->allowC);
    }

    public function __get($name) {
        if (property_exists($this, $name)){
            return $this->$name;
        }else{ 
            return parent::__get($name);
        }
    }
    
    public function __set($name, $value) {
        if (property_exists($this, $name)){
            $this->$name = $value;
        }else{
            parent::__set($name, $value);
        }
    }


}
