<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of Homework
 *
 * @author Choo Meng
 */
class Homework {
    private $homeworkID, $class, $date, $homework;
    public function __construct($homeworkID, $class, $date, $homework) {
        $this->homeworkID = $homeworkID;
        $this->class = $class;
        $this->date = $date;
        $this->homework = $homework;
    }

    public function getHomeworkID() {
        return $this->homeworkID;
    }

    public function getClass() {
        return $this->class;
    }

    public function getDate() {
        return $this->date;
    }

    public function getHomework() {
        return $this->homework;
    }

    public function setHomeworkID($homeworkID): void {
        $this->homeworkID = $homeworkID;
    }

    public function setClass($class): void {
        $this->class = $class;
    }

    public function setDate($date): void {
        $this->date = $date;
    }

    public function setHomework($homework): void {
        $this->homework = $homework;
    }


}
