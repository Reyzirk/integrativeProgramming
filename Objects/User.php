<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of User
 *
 * @author Choo Meng
 */
class User {
    private $userID, $name, $gender, $birthDate, $email, $contactNumber, $icNo, $password, $passwordSalt;
    
    public function __construct($userID, $name, $gender, $birthDate, $email, $contactNumber, $icNo, $password=null, $passwordSalt=null) {
        $this->userID = $userID;
        $this->name = $name;
        $this->gender = $gender;
        $this->birthDate = $birthDate;
        $this->email = $email;
        $this->contactNumber = $contactNumber;
        $this->icNo = $icNo;
        $this->password = $password;
        $this->passwordSalt = $passwordSalt;
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
