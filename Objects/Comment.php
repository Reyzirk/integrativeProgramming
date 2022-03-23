<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * * Description of Comment
 *
 * @author Oon Kheng Huang
 * 
 */

require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/Announcement.php";

class Comment{
    private $commentID;
    private $userID;
    private $announce;
    private $desc;
    private $date;
    
    public function __construct($commentID, $userID, Announcement $announce, $desc, $date) {
        $this->commentID = $commentID;
        $this->userID = $userID;
        $this->announce = $announce;
        $this->desc = $desc;
        $this->date = $date;
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
