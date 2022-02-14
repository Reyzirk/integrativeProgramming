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

    public function getUserID() {
        return $this->userID;
    }

    public function getName() {
        return $this->name;
    }

    public function getGender() {
        return $this->gender;
    }

    public function getBirthDate() {
        return $this->birthDate;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getContactNumber() {
        return $this->contactNumber;
    }

    public function getIcNo() {
        return $this->icNo;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getPasswordSalt() {
        return $this->passwordSalt;
    }

    public function setUserID($userID): void {
        $this->userID = $userID;
    }

    public function setName($name): void {
        $this->name = $name;
    }

    public function setGender($gender): void {
        $this->gender = $gender;
    }

    public function setBirthDate($birthDate): void {
        $this->birthDate = $birthDate;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }

    public function setContactNumber($contactNumber): void {
        $this->contactNumber = $contactNumber;
    }

    public function setIcNo($icNo): void {
        $this->icNo = $icNo;
    }

    public function setPassword($password): void {
        $this->password = $password;
    }

    public function setPasswordSalt($passwordSalt): void {
        $this->passwordSalt = $passwordSalt;
    }


    

}
