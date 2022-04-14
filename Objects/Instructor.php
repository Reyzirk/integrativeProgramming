<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of Instructors
 *
 * @author Choo Meng
 */
require_once "User.php";
class Instructor extends User {
    private $employeeData;
    public function __construct($instructorID, $instructorName, $employeeData, $gender, $birthDate, $email, $contactNumber, $icNo, $password = NULL) {
        parent::__construct($instructorID, $instructorName, $gender, $birthDate, $email, $contactNumber, $icNo, $password);
        $this->employeeData = $employeeData;

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
