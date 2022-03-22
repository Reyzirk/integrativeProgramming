<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * @author Oon Kheng Huang
 */

require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/AnnounceDecorator.php";

class InstructorsAnnounceDecorator extends AnnounceDecorator{
    
    public function __construct($announce) {
        parent::__construct($announce);
    }
    
    public function decorate(){
        return "Good day instructors! Kindly read through the announcement below. &#128522; <br/><br/>".$this->announce->getAnnounceDesc();
    }
    
    
    public function getAnnounceDesc() {
        return $this->decorate();
    }

}

