<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of Examination
 *
 * @author Choo Meng
 */
class Examination {
    private $examinationID, $course, $examiner, $examStartTime, $examDuration;
    
    public function __construct($examinationID, $course, $examiner, $examStartTime, $examDuration) {
        $this->examinationID = $examinationID;
        $this->course = $course;
        $this->examiner = $examiner;
        $this->examStartTime = $examStartTime;
        $this->examDuration = $examDuration;
    }

    public function getExaminationID() {
        return $this->examinationID;
    }

    public function getCourse() {
        return $this->course;
    }

    public function getExaminer() {
        return $this->examiner;
    }

    public function getExamStartTime() {
        return $this->examStartTime;
    }

    public function getExamDuration() {
        return $this->examDuration;
    }

    public function setExaminationID($examinationID): void {
        $this->examinationID = $examinationID;
    }

    public function setCourse($course): void {
        $this->course = $course;
    }

    public function setExaminer($examiner): void {
        $this->examiner = $examiner;
    }

    public function setExamStartTime($examStartTime): void {
        $this->examStartTime = $examStartTime;
    }

    public function setExamDuration($examDuration): void {
        $this->examDuration = $examDuration;
    }


}
