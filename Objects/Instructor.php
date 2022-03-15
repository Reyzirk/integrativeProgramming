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
class Instructor {
    private $instructorID, $instructorName, $employeeData, $gender, $birthDate, $email, $contactNumber, $icNo, $password;
    public function __construct($instructorID, $instructorName, $employeeData, $gender, $birthDate, $email, $contactNumber, $icNo, $password = NULL) {
        $this->instructorID = $instructorID;
        $this->instructorName = $instructorName;
        $this->employeeData = $employeeData;
        $this->gender = $gender;
        $this->birthDate = $birthDate;
        $this->email = $email;
        $this->contactNumber = $contactNumber;
        $this->icNo = $icNo;
        $this->password = $password;
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
