<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of Instructor
 *
 * @author Shu Ling
 */
class Instructor extends User{
    private $employDate;
    public function __construct($userID, $name, $gender, $birthDate, $email, $contactNumber, $icNo, $employDate, $password=null, $passwordSalt=null) {
        $this->userID = $userID;
        $this->name = $name;
        $this->gender = $gender;
        $this->birthDate = $birthDate;
        $this->email = $email;
        $this->contactNumber = $contactNumber;
        $this->icNo = $icNo;
        $this->employDate = $employDate;
        $this->password = $password;
        $this->passwordSalt = $passwordSalt;
    }
    
    public function getEmployDate() {
        return $this->employDate;
    }

    public function setEmployDate($employDate): void {
        $this->employDate = $employDate;
    }

}
