<?php
/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
/**
 * Description of StudClass
 *
 * @author Choo Meng
 */
class StudClass {
    private $classID, $courseList = array(), $studentList = array(), $semester, $year, $formTeacher;
    public function __construct($classID, $courseList, $studentList, $semester, $year, $formTeacher) {
        $this->classID = $classID;
        $this->courseList = $courseList;
        $this->studentList = $studentList;
        $this->semester = $semester;
        $this->year = $year;
        $this->formTeacher = $formTeacher;
    }
    
    public function getClassID() {
        return $this->classID;
    }

    public function getCourseList() {
        return $this->courseList;
    }

    public function getStudentList() {
        return $this->studentList;
    }

    public function getSemester() {
        return $this->semester;
    }

    public function getYear() {
        return $this->year;
    }

    public function getFormTeacher() {
        return $this->formTeacher;
    }

    public function setClassID($classID): void {
        $this->classID = $classID;
    }

    public function setCourseList($courseList): void {
        $this->courseList = $courseList;
    }

    public function setStudentList($studentList): void {
        $this->studentList = $studentList;
    }

    public function setSemester($semester): void {
        $this->semester = $semester;
    }

    public function setYear($year): void {
        $this->year = $year;
    }

    public function setFormTeacher($formTeacher): void {
        $this->formTeacher = $formTeacher;
    }

}
