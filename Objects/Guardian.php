<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of Guardian
 *
 * @author Choo Meng
 */
class Guardian extends User{
    private $address, $totalChild, $emergencyContactNumber, $child;
    
    public function __construct($userID, $name, $gender, $birthDate, $email, $contactNumber, $icNo, 
            $address, $totalChild, $emergencyContactNumber, $child, $password=null, $passwordSalt=null) {
        $this->userID = $userID;
        $this->name = $name;
        $this->gender = $gender;
        $this->birthDate = $birthDate;
        $this->email = $email;
        $this->contactNumber = $contactNumber;
        $this->icNo = $icNo;
        $this->password = $password;
        $this->passwordSalt = $passwordSalt;
        $this->address = $address;
        $this->totalChild = $totalChild;
        $this->emergencyContactNumber = $emergencyContactNumber;
        $this->child = $child;
    }
    public function getAddress() {
        return $this->address;
    }

    public function getTotalChild() {
        return $this->totalChild;
    }

    public function getEmergencyContactNumber() {
        return $this->emergencyContactNumber;
    }

    public function getChild() {
        return $this->child;
    }

    public function setAddress($address): void {
        $this->address = $address;
    }

    public function setTotalChild($totalChild): void {
        $this->totalChild = $totalChild;
    }

    public function setEmergencyContactNumber($emergencyContactNumber): void {
        $this->emergencyContactNumber = $emergencyContactNumber;
    }

    public function setChild($child): void {
        $this->child = $child;
    }


    

}
