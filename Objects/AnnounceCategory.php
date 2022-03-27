<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * @author Oon Kheng Huang
 */

class AnnounceCategory{
    private $id;
    private $name;
    private $desc;
    private $shortF;
    
    public function __construct($id="", $name="", $shortF="", $desc="") {
        $this->id = $id;
        $this->name = $name;
        $this->shortF = $shortF;
        $this->desc = $desc;
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
    
    public function __toString() {
        return "Announcement ID: ".$this->id."<br/> Announcement Type: ".$this->name."<br/> Short Form: ".$this->shortF."<br/> Description: ".$this->desc;
    }
}
