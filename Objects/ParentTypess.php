<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * @author Tang Khai Li
 */

class ParentTypess{
    
    private $id;
    private $type;
    private $shortForm;
    private $description;
    
    public function __construct($id="", $type="", $shortForm="", $description=""){
        $this ->id = $id;
        $this ->type = $type;
        $this ->shortForm = $shortForm;
        $this ->description = $description;
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
       return "Parent ID: ".$this->id."<br/> Parent Type: ".$this->type."<br/> Short Form: ".$this->shortForm."<br/> Description: ".$this->description;
    }
    
    
}
