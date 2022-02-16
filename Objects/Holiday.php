<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of Holiday
 *
 * @author Choo Meng
 */
class Holiday {
    private $id,$name,$dateStart,$dateEnd;
    public function __construct($id,$name, $dateStart, $dateEnd) {
        $this->id = $id;
        $this->name = $name;
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
    }
    public function getId(){
        return $this->id;
    }
    public function getName() {
        return $this->name;
    }

    public function getDateStart() {
        return $this->dateStart;
    }

    public function getDateEnd() {
        return $this->dateEnd;
    }

    public function setName($name): void {
        $this->name = $name;
    }

    public function setDateStart($dateStart): void {
        $this->dateStart = $dateStart;
    }

    public function setDateEnd($dateEnd): void {
        $this->dateEnd = $dateEnd;
    }
    public function setId($id){
        $this->id = $id;
    }

}
