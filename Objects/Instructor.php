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
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/User.php";

class Instructor extends User {
    private $employeeDate;
    public function __construct($instructorID, $instructorName, $employeeDate, $gender, $birthDate, $email, $contactNumber, $icNo, $password = NULL) {
        parent::__construct($instructorID, $instructorName, $gender, $birthDate, $email, $contactNumber, $icNo, $password);
        $this->employeeDate = $employeeDate;

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
