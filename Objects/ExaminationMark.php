<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of ExaminationMark
 *
 * @author Choo Meng
 */
class ExaminationMark {
    private $examination, $student, $mark;
    
    public function __construct($examination, $student, $mark) {
        $this->examination = $examination;
        $this->student = $student;
        $this->mark = $mark;
    }
    
    public function getExamination() {
        return $this->examination;
    }

    public function getStudent() {
        return $this->student;
    }

    public function getMark() {
        return $this->mark;
    }

    public function setExamination($examination): void {
        $this->examination = $examination;
    }

    public function setStudent($student): void {
        $this->student = $student;
    }

    public function setMark($mark): void {
        $this->mark = $mark;
    }


}
