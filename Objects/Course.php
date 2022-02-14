<?php
/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
/**
 * Description of Course
 *
 * @author Choo Meng
 */
class Course {
    private $courseCode, $courseName, $courseDesc;
    function __construct($courseCode, $courseName, $courseDesc){
        $this->courseCode = $courseCode;
        $this->courseName = $courseName;
        $this->courseDesc = $courseDesc;
    }
    public function getCourseCode() {
        return $this->courseCode;
    }

    public function getCourseName() {
        return $this->courseName;
    }

    public function getCourseDesc() {
        return $this->courseDesc;
    }

    public function setCourseCode($courseCode): void {
        $this->courseCode = $courseCode;
    }

    public function setCourseName($courseName): void {
        $this->courseName = $courseName;
    }

    public function setCourseDesc($courseDesc): void {
        $this->courseDesc = $courseDesc;
    }


}
