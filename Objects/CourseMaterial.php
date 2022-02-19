<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of CourseMaterial
 *
 * @author Choo Meng
 */
class CourseMaterial {
    private $materialID, $materialName, $materialLink;
    public function __construct($materialID, $materialName, $materialLink) {
        $this->materialID = $materialID;
        $this->materialName = $materialName;
        $this->materialLink = $materialLink;
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
